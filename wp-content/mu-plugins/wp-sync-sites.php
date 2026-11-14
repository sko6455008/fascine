<?php
/**
 * Plugin Name: WordPress Sites Sync
 * Description: FascinaとTwelorのカスタム投稿タイプとメディアを双方向リアルタイム同期するプラグイン
 * Version: 1.1.0
 * Author: Custom
 * 
 * 設定: wp-config.phpに以下を定義してください
 * define('SYNC_SITE_URL', 'http://twelor.local');
 * define('SYNC_AUTH_USER', 'admin');
 * define('SYNC_AUTH_PASS', 'application_password');
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// 同期対象のカスタム投稿タイプ
define('WPS_SYNC_POST_TYPES', array('gallery', 'course', 'coupon', 'nailist', 'banner', 'qa', 'process_chart'));

/**
 * プラグインの初期化
 */
function wps_sync_init() {
    // 設定が定義されているかチェック
    if (!defined('SYNC_SITE_URL') || !defined('SYNC_AUTH_USER') || !defined('SYNC_AUTH_PASS')) {
        return;
    }
    
    // 同期が無効な場合はスキップ
    if (defined('SYNC_DISABLED') && SYNC_DISABLED) {
        return;
    }
    
    // 投稿の同期フック
    add_action('save_post', 'wps_sync_post', 10, 3);
    add_action('delete_post', 'wps_sync_delete_post', 10, 1);
    add_action('trashed_post', 'wps_sync_delete_post', 10, 1);
    
    // メディアの同期フック
    add_action('add_attachment', 'wps_sync_media', 10, 1);
    add_action('edit_attachment', 'wps_sync_media', 10, 1);
    add_action('delete_attachment', 'wps_sync_delete_media', 10, 1);
    add_action('wps_sync_retry', 'wps_sync_retry', 10, 2);
    
    // タームの同期フック
    add_action('created_term', 'wps_sync_term', 10, 3);
    add_action('edited_term', 'wps_sync_term', 10, 3);
    add_action('delete_term', 'wps_sync_delete_term', 10, 4);
    
    // REST APIエンドポイントの登録
    add_action('rest_api_init', 'wps_sync_register_rest_routes');
}
add_action('init', 'wps_sync_init', 1);

/**
 * 無限ループ防止: 同期中かどうかをチェック
 */
function wps_sync_is_syncing($object_id = null, $type = 'post') {
    if ($object_id) {
        $meta_type = $type === 'term' ? 'term' : 'post';
        if (get_metadata($meta_type, $object_id, '_sync_in_progress', true) !== '1') {
            return false;
        }
        $started = (int) get_metadata($meta_type, $object_id, '_sync_started_at', true);
        if (!$started) {
            // 旧版が残したフラグも、確認してから10分で失効させる。
            update_metadata($meta_type, $object_id, '_sync_started_at', time());
        } elseif ($started < time() - 10 * MINUTE_IN_SECONDS) {
            wps_sync_set_syncing($object_id, false, $type);
            return false;
        }
        return true;
    }
    return defined('WPS_SYNC_IN_PROGRESS') && WPS_SYNC_IN_PROGRESS;
}

/**
 * 無限ループ防止: 同期フラグをセット
 */
function wps_sync_set_syncing($object_id, $value = true, $type = 'post') {
    $meta_type = $type === 'term' ? 'term' : 'post';
    if ($value) {
        update_metadata($meta_type, $object_id, '_sync_started_at', time());
        if ($type === 'term') {
            update_term_meta($object_id, '_sync_in_progress', '1');
        } else {
            update_post_meta($object_id, '_sync_in_progress', '1');
        }
        if (!defined('WPS_SYNC_IN_PROGRESS')) {
            define('WPS_SYNC_IN_PROGRESS', true);
        }
    } else {
        delete_metadata($meta_type, $object_id, '_sync_started_at');
        if ($type === 'term') {
            delete_term_meta($object_id, '_sync_in_progress');
        } else {
            delete_post_meta($object_id, '_sync_in_progress');
        }
    }
}

/** ロック・再送状態はサイト固有なので、相手にコピーしない。 */
function wps_sync_is_internal_meta($key) {
    return strpos($key, '_sync_') === 0 || strpos($key, '_edit_') === 0;
}

/** 送信前に再送を予約する。PHPが途中終了しても次回のWP-Cronで再試行できる。 */
function wps_sync_schedule_retry($object_id, $type) {
    $args = array((int) $object_id, $type);
    if (wp_next_scheduled('wps_sync_retry', $args)) {
        return;
    }
    $attempt = min(4, (int) get_post_meta($object_id, '_sync_retry_attempt', true));
    $delays = array(60, 300, 900, 3600, 3600);
    $scheduled = wp_schedule_single_event(time() + $delays[$attempt], 'wps_sync_retry', $args, true);
    if (is_wp_error($scheduled) || !$scheduled) {
        error_log('WPS Sync Error: Failed to schedule retry for ' . $type . ' ID ' . $object_id);
        return;
    }
    update_post_meta($object_id, '_sync_retry_attempt', min(4, $attempt + 1));
}

function wps_sync_clear_retry($object_id, $type) {
    wp_clear_scheduled_hook('wps_sync_retry', array((int) $object_id, $type));
    delete_post_meta($object_id, '_sync_retry_attempt');
}

/** 保存済みの古いペイロードではなく、最新の投稿・画像を再送する。 */
function wps_sync_retry($object_id, $type) {
    $post = get_post($object_id);
    if (!$post || $post->post_status === 'trash' ||
        ($type === 'media' ? $post->post_type !== 'attachment' : !in_array($post->post_type, WPS_SYNC_POST_TYPES, true))) {
        wps_sync_clear_retry($object_id, $type);
        return;
    }
    if (wps_sync_is_syncing($object_id)) {
        wps_sync_schedule_retry($object_id, $type);
        return;
    }
    if ($type === 'media') {
        wps_sync_media($object_id);
    } else {
        wps_sync_post($object_id, $post, true);
    }
}

/** DBの添付情報だけでなく、実ファイルと表示に使うサイズも確認する。 */
function wps_sync_media_is_ready($attachment_id) {
    $attachment = get_post($attachment_id);
    $file = get_attached_file($attachment_id);
    if (!$attachment || $attachment->post_type !== 'attachment' || !$file || !is_file($file) || !filesize($file)) {
        return false;
    }
    if (wp_attachment_is_image($attachment_id)) {
        $meta = wp_get_attachment_metadata($attachment_id);
        if (empty($meta['width']) || empty($meta['height'])) {
            return false;
        }
        foreach (array('thumbnail', 'large') as $size) {
            $image = image_get_intermediate_size($attachment_id, $size);
            if ($image && !is_file(dirname($file) . '/' . $image['file'])) {
                return false;
            }
        }
    }
    return true;
}

/** 投稿の送信前に欠落したアイキャッチ画像を補完する。 */
function wps_sync_ensure_remote_media($attachment_id) {
    $status = wps_sync_remote_request('media/' . (int) $attachment_id, 'GET');
    if (!is_array($status) || empty($status['success']) || (int) ($status['attachment_id'] ?? 0) !== (int) $attachment_id) {
        return false;
    }
    return !empty($status['ready']) || wps_sync_media($attachment_id);
}

/**
 * リモートサイトにHTTPリクエストを送信
 */
function wps_sync_remote_request($endpoint, $method = 'POST', $data = array()) {
    $url = trailingslashit(SYNC_SITE_URL) . 'wp-json/sync/v1/' . ltrim($endpoint, '/');

    // Application Passwordのスペースを削除（WordPressのApplication Passwordはスペースを含む形式で表示されるが、使用時はスペースを削除する必要がある）
    $auth_pass = str_replace(' ', '', SYNC_AUTH_PASS);

    $body = null;
    if (!empty($data)) {
        $body = json_encode($data);
        // メディア画像などの大きなペイロードでjson_encodeが失敗すると、
        // 本文が空のまま送信され、受信側で「Missing required fields」となって
        // 画像が添付されない。失敗を検知してログを残し、中断する。
        if ($body === false) {
            error_log('WPS Sync Error: json_encode failed (payload too large or invalid) | URL: ' . $url . ' | json_last_error: ' . json_last_error_msg());
            return false;
        }
    }

    // メディア同期は画像本体(base64)を含み転送に時間がかかるため、タイムアウトを長めに取る
    $is_media = (strpos(ltrim($endpoint, '/'), 'media') === 0);

    $args = array(
        'method' => $method,
        'timeout' => $is_media ? 60 : 30,
        'headers' => array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(SYNC_AUTH_USER . ':' . $auth_pass),
        ),
    );

    if ($body !== null) {
        $args['body'] = $body;
    }

    // 一時的な接続エラー・タイムアウト・5xxで画像同期が取りこぼされるのを防ぐため、数回までリトライする。
    // 同じ画像の再送では既存ファイルを再利用する。
    $max_attempts = 2;

    for ($attempt = 1; $attempt <= $max_attempts; $attempt++) {
        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            error_log('WPS Sync Error (attempt ' . $attempt . '/' . $max_attempts . '): ' . $response->get_error_message() . ' | URL: ' . $url);
            // 接続エラー・タイムアウトはリトライ
            if ($attempt < $max_attempts) {
                continue;
            }
            return false;
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);

        if ($response_code >= 200 && $response_code < 300) {
            return json_decode($response_body, true);
        }

        // 5xxはリモート側の一時的な障害の可能性があるためリトライ
        if ($response_code >= 500 && $attempt < $max_attempts) {
            error_log('WPS Sync Warning (attempt ' . $attempt . '/' . $max_attempts . '): HTTP ' . $response_code . ' | URL: ' . $url);
            continue;
        }

        // HTTP 400エラーで「Already syncing」の場合、リモート側の同期フラグが残っている可能性がある
        // 即時再送ではなく、WP-Cronの遅延再送でロックの解放を待つ。
        if ($response_code === 400) {
            $response_data = json_decode($response_body, true);
            if (isset($response_data['code']) && $response_data['code'] === 'syncing') {
                error_log('WPS Sync Warning: Remote site is already syncing. This may be due to a previous connection error. | URL: ' . $url);
                // リモート側の同期フラグはタイムアウト処理により自動的に解除されるため、ここでは何もしない
            }
        }

        error_log('WPS Sync Error: HTTP ' . $response_code . ' | URL: ' . $url . ' | Response: ' . $response_body);
        return false;
    }

    return false;
}

/**
 * 投稿の同期（新規作成・更新）
 */
function wps_sync_post($post_id, $post, $update) {
    // 無限ループ防止
    if (wps_sync_is_syncing($post_id)) {
        return;
    }
    
    // リビジョンは同期しない
    if ($post->post_type === 'revision') {
        return;
    }
    
    // 自動保存は同期しない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // 同期対象の投稿タイプかチェック
    if (!in_array($post->post_type, WPS_SYNC_POST_TYPES)) {
        return;
    }
    
    wps_sync_schedule_retry($post_id, 'post');
    $success = false;
    // 同期フラグをセット
    wps_sync_set_syncing($post_id, true);
    
    try {
        // 投稿データを取得
        $post_data = wps_sync_get_post_data($post_id);
        
        if ($post_data) {
            if (!empty($post_data['thumbnail_id']) && !wps_sync_ensure_remote_media($post_data['thumbnail_id'])) {
                return false;
            }
            // リモートサイトに送信
            $result = wps_sync_remote_request('post', 'POST', $post_data);
            $success = is_array($result) && !empty($result['success']) && (int) ($result['post_id'] ?? 0) === (int) $post_id;
        }
    } catch (Throwable $e) {
        error_log('WPS Sync Exception: ' . $e->getMessage() . ' | Post ID: ' . $post_id);
    } finally {
        // エラーが発生しても必ず同期フラグを解除
        wps_sync_set_syncing($post_id, false);
        if ($success) {
            wps_sync_clear_retry($post_id, 'post');
        }
    }
    return $success;
}

/**
 * 投稿データを取得
 */
function wps_sync_get_post_data($post_id) {
    $post = get_post($post_id);
    if (!$post) {
        return false;
    }
    
    // 基本データ
    $data = array(
        'id' => $post->ID,
        'post_title' => $post->post_title,
        'post_content' => $post->post_content,
        'post_excerpt' => $post->post_excerpt,
        'post_status' => $post->post_status,
        'post_type' => $post->post_type,
        'post_name' => $post->post_name,
        'post_date' => $post->post_date,
        'post_date_gmt' => $post->post_date_gmt,
        'post_modified' => $post->post_modified,
        'post_modified_gmt' => $post->post_modified_gmt,
        'menu_order' => $post->menu_order,
    );
    
    // アイキャッチ画像
    $thumbnail_id = get_post_thumbnail_id($post_id);
    if ($thumbnail_id) {
        $data['thumbnail_id'] = $thumbnail_id;
    }
    
    // メタデータを取得（すべて）
    $meta_data = get_post_meta($post_id);
    $data['meta'] = array();
    foreach ($meta_data as $key => $values) {
        // 同期用の内部メタは除外
        if (wps_sync_is_internal_meta($key)) {
            continue;
        }
        // 配列の場合は最初の要素、単一値の場合はそのまま
        $data['meta'][$key] = is_array($values) && count($values) === 1 ? $values[0] : $values;
    }
    
    // ACFフィールドを取得（ACFが有効な場合）
    if (function_exists('get_fields')) {
        $acf_fields = get_fields($post_id);
        if ($acf_fields) {
            $data['acf'] = $acf_fields;
        }
    }
    
    // タームの紐付けを取得
    $taxonomies = get_object_taxonomies($post->post_type);
    $data['terms'] = array();
    foreach ($taxonomies as $taxonomy) {
        $terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'ids'));
        if (!is_wp_error($terms) && !empty($terms)) {
            $data['terms'][$taxonomy] = $terms;
        }
    }
    
    return $data;
}

/**
 * 投稿の削除を同期
 */
function wps_sync_delete_post($post_id) {
    wps_sync_clear_retry($post_id, 'post');
    // 無限ループ防止
    if (wps_sync_is_syncing($post_id)) {
        return;
    }
    
    $post = get_post($post_id);
    if (!$post) {
        return;
    }
    
    // 同期対象の投稿タイプかチェック
    if (!in_array($post->post_type, WPS_SYNC_POST_TYPES)) {
        return;
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($post_id, true);
    
    try {
        // リモートサイトから削除
        wps_sync_remote_request('post/' . $post_id, 'DELETE');
    } catch (Exception $e) {
        error_log('WPS Sync Exception: ' . $e->getMessage() . ' | Post ID: ' . $post_id);
    } finally {
        // エラーが発生しても必ず同期フラグを解除
        wps_sync_set_syncing($post_id, false);
    }
}

/**
 * メディアの同期（新規作成・更新）
 */
function wps_sync_media($attachment_id) {
    // 無限ループ防止
    if (wps_sync_is_syncing($attachment_id)) {
        return false;
    }
    
    $attachment = get_post($attachment_id);
    if (!$attachment || $attachment->post_type !== 'attachment') {
        return false;
    }
    
    wps_sync_schedule_retry($attachment_id, 'media');
    $success = false;
    // 同期フラグをセット
    wps_sync_set_syncing($attachment_id, true);
    
    try {
        // メディアデータを取得
        $media_data = wps_sync_get_media_data($attachment_id);
        
        if ($media_data) {
            // リモートサイトに送信
            $result = wps_sync_remote_request('media', 'POST', $media_data);
            $success = is_array($result) && !empty($result['success']) && (int) ($result['attachment_id'] ?? 0) === (int) $attachment_id;
        }
    } catch (Throwable $e) {
        error_log('WPS Sync Exception: ' . $e->getMessage() . ' | Attachment ID: ' . $attachment_id);
    } finally {
        // エラーが発生しても必ず同期フラグを解除
        wps_sync_set_syncing($attachment_id, false);
        if ($success) {
            wps_sync_clear_retry($attachment_id, 'media');
        }
    }
    return $success;
}

/**
 * メディアデータを取得
 */
function wps_sync_get_media_data($attachment_id) {
    $attachment = get_post($attachment_id);
    if (!$attachment || $attachment->post_type !== 'attachment') {
        return false;
    }
    
    $file_path = get_attached_file($attachment_id);
    if (!$file_path || !file_exists($file_path)) {
        return false;
    }
    
    // ファイルデータを読み込む
    $file_data = file_get_contents($file_path);
    if ($file_data === false) {
        return false;
    }
    
    // メディア情報を取得
    $attachment_meta = wp_get_attachment_metadata($attachment_id);
    $mime_type = get_post_mime_type($attachment_id);
    
    $data = array(
        'id' => $attachment_id,
        'post_title' => $attachment->post_title,
        'post_content' => $attachment->post_content,
        'post_excerpt' => $attachment->post_excerpt,
        'post_date' => $attachment->post_date,
        'post_date_gmt' => $attachment->post_date_gmt,
        'mime_type' => $mime_type,
        'file_name' => basename($file_path),
        'file_data' => base64_encode($file_data),
        'attachment_meta' => $attachment_meta,
    );
    
    // メタデータを取得
    $meta_data = get_post_meta($attachment_id);
    $data['meta'] = array();
    foreach ($meta_data as $key => $values) {
        if (wps_sync_is_internal_meta($key)) {
            continue;
        }
        $data['meta'][$key] = is_array($values) && count($values) === 1 ? $values[0] : $values;
    }
    
    return $data;
}

/**
 * メディアの削除を同期
 */
function wps_sync_delete_media($attachment_id) {
    wps_sync_clear_retry($attachment_id, 'media');
    // 無限ループ防止
    if (wps_sync_is_syncing($attachment_id)) {
        return;
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($attachment_id, true);
    
    try {
        // リモートサイトから削除
        wps_sync_remote_request('media/' . $attachment_id, 'DELETE');
    } catch (Exception $e) {
        error_log('WPS Sync Exception: ' . $e->getMessage() . ' | Attachment ID: ' . $attachment_id);
    } finally {
        // エラーが発生しても必ず同期フラグを解除
        wps_sync_set_syncing($attachment_id, false);
    }
}

/**
 * タームの同期（新規作成・更新）
 */
function wps_sync_term($term_id, $tt_id, $taxonomy) {
    // 無限ループ防止
    if (wps_sync_is_syncing($term_id, 'term')) {
        return;
    }
    
    $term = get_term($term_id, $taxonomy);
    if (!$term || is_wp_error($term)) {
        return;
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($term_id, true, 'term');
    
    // タームデータを取得
    $term_data = wps_sync_get_term_data($term_id, $taxonomy);
    
    if ($term_data) {
        // リモートサイトに送信
        wps_sync_remote_request('term', 'POST', $term_data);
    }
    
    // 同期フラグを解除
    wps_sync_set_syncing($term_id, false, 'term');
}

/**
 * タームデータを取得
 */
function wps_sync_get_term_data($term_id, $taxonomy) {
    $term = get_term($term_id, $taxonomy);
    if (!$term || is_wp_error($term)) {
        return false;
    }
    
    $data = array(
        'term_id' => $term->term_id,
        'term_taxonomy_id' => $term->term_taxonomy_id,
        'name' => $term->name,
        'slug' => $term->slug,
        'taxonomy' => $taxonomy,
        'description' => $term->description,
        'parent' => $term->parent,
        'term_group' => $term->term_group,
    );
    
    // メタデータを取得
    $meta_data = get_term_meta($term_id);
    $data['meta'] = array();
    foreach ($meta_data as $key => $values) {
        if (wps_sync_is_internal_meta($key)) {
            continue;
        }
        $data['meta'][$key] = is_array($values) && count($values) === 1 ? $values[0] : $values;
    }
    
    return $data;
}

/**
 * タームの削除を同期
 */
function wps_sync_delete_term($term_id, $tt_id, $taxonomy, $deleted_term) {
    // 無限ループ防止
    if (wps_sync_is_syncing($term_id, 'term')) {
        return;
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($term_id, true, 'term');
    
    try {
        // リモートサイトから削除
        wps_sync_remote_request('term/' . $term_id . '/' . $taxonomy, 'DELETE');
    } catch (Exception $e) {
        error_log('WPS Sync Exception: ' . $e->getMessage() . ' | Term ID: ' . $term_id);
    } finally {
        // エラーが発生しても必ず同期フラグを解除
        wps_sync_set_syncing($term_id, false, 'term');
    }
}

/**
 * REST APIエンドポイントの登録
 */
function wps_sync_register_rest_routes() {
    // 投稿の作成・更新
    register_rest_route('sync/v1', '/post', array(
        'methods' => 'POST',
        'callback' => 'wps_sync_rest_post',
        'permission_callback' => 'wps_sync_rest_permission_check',
    ));
    
    // 投稿の削除
    register_rest_route('sync/v1', '/post/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'wps_sync_rest_delete_post',
        'permission_callback' => 'wps_sync_rest_permission_check',
        'args' => array(
            'id' => array(
                'required' => true,
                'type' => 'integer',
            ),
        ),
    ));
    
    // メディアの作成・更新
    register_rest_route('sync/v1', '/media', array(
        'methods' => 'POST',
        'callback' => 'wps_sync_rest_media',
        'permission_callback' => 'wps_sync_rest_permission_check',
    ));

    register_rest_route('sync/v1', '/media/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'wps_sync_rest_media_status',
        'permission_callback' => 'wps_sync_rest_permission_check',
    ));
    
    // メディアの削除
    register_rest_route('sync/v1', '/media/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'wps_sync_rest_delete_media',
        'permission_callback' => 'wps_sync_rest_permission_check',
        'args' => array(
            'id' => array(
                'required' => true,
                'type' => 'integer',
            ),
        ),
    ));
    
    // タームの作成・更新
    register_rest_route('sync/v1', '/term', array(
        'methods' => 'POST',
        'callback' => 'wps_sync_rest_term',
        'permission_callback' => 'wps_sync_rest_permission_check',
    ));
    
    // タームの削除
    register_rest_route('sync/v1', '/term/(?P<id>\d+)/(?P<taxonomy>[a-zA-Z0-9_-]+)', array(
        'methods' => 'DELETE',
        'callback' => 'wps_sync_rest_delete_term',
        'permission_callback' => 'wps_sync_rest_permission_check',
        'args' => array(
            'id' => array(
                'required' => true,
                'type' => 'integer',
            ),
            'taxonomy' => array(
                'required' => true,
                'type' => 'string',
            ),
        ),
    ));
}

/**
 * REST API権限チェック
 */
function wps_sync_rest_permission_check($request) {
    // 設定が定義されているかチェック
    if (!defined('SYNC_AUTH_USER') || !defined('SYNC_AUTH_PASS')) {
        return false;
    }
    
    // Basic認証でチェック
    $auth_header = $request->get_header('Authorization');
    if (!$auth_header) {
        return false;
    }
    
    // Basic認証の形式: "Basic base64(username:password)"
    if (strpos($auth_header, 'Basic ') !== 0) {
        return false;
    }
    
    $encoded = substr($auth_header, 6);
    $decoded = base64_decode($encoded);
    list($username, $password) = explode(':', $decoded, 2);
    
    // ユーザー名が一致するかチェック
    if ($username !== SYNC_AUTH_USER) {
        return false;
    }
    
    // Application Passwordのスペースを削除
    $expected_password = str_replace(' ', '', SYNC_AUTH_PASS);
    $received_password = $password;
    
    // Application Passwordで認証
    if (function_exists('wp_authenticate_application_password')) {
        $user = wp_authenticate_application_password(null, $username, $received_password);
        if (!is_wp_error($user) && $user) {
            return true;
        }
    }
    
    // 通常の認証（フォールバック）
    $user = wp_authenticate($username, $received_password);
    if (!is_wp_error($user) && $user) {
        return true;
    }
    
    // Application Passwordを直接比較（最後の手段）
    if ($received_password === $expected_password) {
        $user = get_user_by('login', $username);
        if ($user && user_can($user, 'edit_posts')) {
            return true;
        }
    }
    
    return false;
}

/**
 * REST API: 投稿の作成・更新
 */
function wps_sync_rest_post($request) {
    $data = $request->get_json_params();
    
    if (!isset($data['id']) || !isset($data['post_type'])) {
        return new WP_Error('invalid_data', 'Missing required fields', array('status' => 400));
    }
    
    $post_id = intval($data['id']);
    $post_type = sanitize_text_field($data['post_type']);
    
    // 同期対象の投稿タイプかチェック
    if ($post_id < 1 || !in_array($post_type, WPS_SYNC_POST_TYPES)) {
        return new WP_Error('invalid_post_type', 'Invalid post type', array('status' => 400));
    }
    
    // 無限ループ防止
    if (wps_sync_is_syncing($post_id)) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }

    $existing = get_post($post_id);
    if ($existing && $existing->post_type !== $post_type) {
        return new WP_Error('id_conflict', 'ID belongs to another post type', array('status' => 409));
    }
    $thumb_id = (int) ($data['thumbnail_id'] ?? ($data['meta']['_thumbnail_id'] ?? 0));
    if ($thumb_id && (!wp_attachment_is_image($thumb_id) || !wps_sync_media_is_ready($thumb_id))) {
        // 既存の投稿・画像を壊さずに再送を要求する。
        return new WP_Error('missing_thumbnail', 'Thumbnail media must be synced first', array('status' => 409));
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($post_id, true);
    try {
        $response = wps_sync_receive_post($data);
        if (!is_wp_error($response)) {
            wps_sync_clear_retry($post_id, 'post');
        }
        return $response;
    } finally {
        wps_sync_set_syncing($post_id, false);
    }
}

function wps_sync_receive_post($data) {
    $post_id = (int) $data['id'];
    $post_type = sanitize_text_field($data['post_type']);
    
    // 既存の投稿があるかチェック
    $existing_post = get_post($post_id);
    
    // 投稿データを準備
    $post_data = array(
        'import_id' => $post_id, // IDを指定
        'post_title' => isset($data['post_title']) ? sanitize_text_field($data['post_title']) : '',
        'post_content' => isset($data['post_content']) ? wp_kses_post($data['post_content']) : '',
        'post_excerpt' => isset($data['post_excerpt']) ? sanitize_textarea_field($data['post_excerpt']) : '',
        'post_status' => isset($data['post_status']) ? sanitize_text_field($data['post_status']) : 'publish',
        'post_type' => $post_type,
        'post_name' => isset($data['post_name']) ? sanitize_title($data['post_name']) : '',
        'post_date' => isset($data['post_date']) ? sanitize_text_field($data['post_date']) : current_time('mysql'),
        'post_date_gmt' => isset($data['post_date_gmt']) ? sanitize_text_field($data['post_date_gmt']) : current_time('mysql', 1),
        'menu_order' => isset($data['menu_order']) ? intval($data['menu_order']) : 0,
    );
    
    if ($existing_post) {
        // 更新
        $post_data['ID'] = $post_id;
        $result = wp_update_post($post_data, true);
    } else {
        // import_idで指定できるため、テーブル全体の採番変更は不要。
        $result = wp_insert_post($post_data, true);
    }
    
    if (is_wp_error($result)) {
        return $result;
    }
    if ((int) $result !== $post_id) {
        return new WP_Error('id_conflict', 'Imported post ID does not match', array('status' => 409));
    }
    
    $final_post_id = $result;
    
    // メタデータを完全置き換え
    if (isset($data['meta']) && is_array($data['meta'])) {
        // 既存のメタデータを削除（同期用の内部メタを除く）
        $existing_meta = get_post_meta($final_post_id);
        foreach ($existing_meta as $key => $values) {
            if (!wps_sync_is_internal_meta($key)) {
                delete_post_meta($final_post_id, $key);
            }
        }
        
        // 新しいメタデータを追加
        foreach ($data['meta'] as $key => $value) {
            if (!wps_sync_is_internal_meta($key)) {
                update_post_meta($final_post_id, sanitize_key($key), $value);
            }
        }
    }
    
    // ACFフィールドを更新
    if (isset($data['acf']) && is_array($data['acf']) && function_exists('update_field')) {
        foreach ($data['acf'] as $key => $value) {
            update_field($key, $value, $final_post_id);
        }
    }
    
    // アイキャッチ画像を設定
    if (isset($data['thumbnail_id'])) {
        $thumb_id = intval($data['thumbnail_id']);
        if ($thumb_id) {
            set_post_thumbnail($final_post_id, $thumb_id);
            if ((int) get_post_thumbnail_id($final_post_id) !== $thumb_id) {
                return new WP_Error('thumbnail_error', 'Failed to set thumbnail', array('status' => 500));
            }
        }
    }
    
    // タームの紐付けを更新（完全置き換え）
    if (isset($data['terms']) && is_array($data['terms'])) {
        foreach ($data['terms'] as $taxonomy => $term_ids) {
            if (taxonomy_exists($taxonomy)) {
                $term_ids = array_map('intval', $term_ids);
                wp_set_object_terms($final_post_id, $term_ids, sanitize_text_field($taxonomy));
            }
        }
    }
    
    return new WP_REST_Response(array(
        'success' => true,
        'post_id' => $final_post_id,
    ), 200);
}

/**
 * REST API: 投稿の削除
 */
function wps_sync_rest_delete_post($request) {
    $post_id = intval($request->get_param('id'));
    
    // 無限ループ防止
    if (wps_sync_is_syncing($post_id)) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($post_id, true);
    
    // 投稿を完全削除
    wp_delete_post($post_id, true);
    
    // 同期フラグを解除
    wps_sync_set_syncing($post_id, false);
    
    return new WP_REST_Response(array(
        'success' => true,
    ), 200);
}

/**
 * REST API: メディアの存在確認（ファイル本体も確認）
 */
function wps_sync_rest_media_status($request) {
    $attachment_id = (int) $request->get_param('id');
    $attachment = get_post($attachment_id);
    if ($attachment && $attachment->post_type !== 'attachment') {
        return new WP_Error('id_conflict', 'ID belongs to another post type', array('status' => 409));
    }
    if (wps_sync_is_syncing($attachment_id)) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }
    return new WP_REST_Response(array(
        'success' => true,
        'attachment_id' => $attachment_id,
        'ready' => wps_sync_media_is_ready($attachment_id),
    ), 200);
}

/**
 * REST API: メディアの作成・更新
 */
function wps_sync_rest_media($request) {
    $data = $request->get_json_params();
    
    if (!isset($data['id']) || !isset($data['file_data']) || !isset($data['file_name']) || !isset($data['mime_type'])) {
        return new WP_Error('invalid_data', 'Missing required fields', array('status' => 400));
    }
    
    $attachment_id = intval($data['id']);
    if ($attachment_id < 1 || !is_string($data['file_data'])) {
        return new WP_Error('invalid_data', 'Invalid media data', array('status' => 400));
    }
    
    // 無限ループ防止
    if (wps_sync_is_syncing($attachment_id)) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }
    $existing = get_post($attachment_id);
    if ($existing && $existing->post_type !== 'attachment') {
        return new WP_Error('id_conflict', 'ID belongs to another post type', array('status' => 409));
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($attachment_id, true);
    try {
        $response = wps_sync_receive_media($data);
        if (!is_wp_error($response)) {
            wps_sync_clear_retry($attachment_id, 'media');
        }
        return $response;
    } finally {
        wps_sync_set_syncing($attachment_id, false);
    }
}

function wps_sync_receive_media($data) {
    $attachment_id = (int) $data['id'];
    
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    $file_data = base64_decode($data['file_data'], true);
    if ($file_data === false || $file_data === '') {
        return new WP_Error('invalid_media_data', 'Invalid or empty media payload', array('status' => 400));
    }
    $old_file = get_attached_file($attachment_id);
    $same_file = $old_file && is_file($old_file) && hash_file('sha256', $old_file) === hash('sha256', $file_data);
    $was_ready = $same_file && wps_sync_media_is_ready($attachment_id);
    if ($same_file) {
        // 応答だけが途絶えた後の再送でも、連番ファイルを作らない。
        $upload = array('file' => $old_file);
    } else {
        $tmp = wp_tempnam('wps-media-');
        if (!$tmp) {
            return new WP_Error('temp_file_error', 'Failed to create temp file', array('status' => 500));
        }
        try {
            if (file_put_contents($tmp, $file_data) !== strlen($file_data)) {
                return new WP_Error('write_error', 'Failed to write complete media file', array('status' => 500));
            }
            $file_array = array(
                'name' => sanitize_file_name($data['file_name']),
                'tmp_name' => $tmp,
            );
            $upload = wp_handle_sideload($file_array, array('test_form' => false), $data['post_date'] ?? null);
        } finally {
            if (is_file($tmp)) {
                @unlink($tmp);
            }
        }
        if (isset($upload['error'])) {
            return new WP_Error('upload_error', $upload['error'], array('status' => 500));
        }
    }
    
    // 既存のメディアがあるかチェック
    $existing_attachment = get_post($attachment_id);
    
    // メディアを登録
    $attachment_data = array(
        'post_title' => isset($data['post_title']) ? sanitize_text_field($data['post_title']) : basename($upload['file']),
        'post_content' => isset($data['post_content']) ? wp_kses_post($data['post_content']) : '',
        'post_excerpt' => isset($data['post_excerpt']) ? sanitize_textarea_field($data['post_excerpt']) : '',
        'post_mime_type' => sanitize_mime_type($data['mime_type']),
        'post_date' => isset($data['post_date']) ? sanitize_text_field($data['post_date']) : current_time('mysql'),
        'post_date_gmt' => isset($data['post_date_gmt']) ? sanitize_text_field($data['post_date_gmt']) : current_time('mysql', 1),
    );
    
    if ($existing_attachment) {
        // 新しいファイルの保存が確認できるまで古いファイルを残す。
        $attachment_data['ID'] = $attachment_id;
        $result = wp_update_post($attachment_data, true);
    } else {
        // 新規作成（ID指定）
        $attachment_data['import_id'] = $attachment_id;
        $result = wp_insert_attachment($attachment_data, $upload['file'], 0, true);
    }
    
    if (is_wp_error($result)) {
        if (!$same_file) {
            @unlink($upload['file']);
        }
        return $result;
    }
    if ((int) $result !== $attachment_id) {
        return new WP_Error('id_conflict', 'Imported media ID does not match', array('status' => 409));
    }
    
    $final_attachment_id = $result;

    /**
     * ここから安全対策:
     * - Twelor側で常に _wp_attached_file を正しく設定する
     * - attachment_meta['file'] と実ファイルパスのズレを最小化する
     *
     * これにより、既存データの更新時にもメディアパスの不整合が起きにくくなる
     */

    // アップロードされたファイルの相対パスを算出
    $relative_path = '';
    $upload_dir = wp_get_upload_dir();
    if (!empty($upload_dir['basedir']) && strpos($upload['file'], $upload_dir['basedir']) === 0) {
        $relative_path = ltrim(str_replace($upload_dir['basedir'], '', $upload['file']), '/\\');
    } else {
        // フォールバックとしてファイル名のみ
        $relative_path = basename($upload['file']);
    }

    // _wp_attached_file を常に最新の相対パスで更新
    if ($relative_path) {
        update_post_meta($final_attachment_id, '_wp_attached_file', $relative_path);
    }

    // メタデータを完全置き換え（_wp_attachment_metadata と _wp_attached_file を除外）
    if (isset($data['meta']) && is_array($data['meta'])) {
        // 既存のメタデータを削除（_wp_attachment_metadata・_wp_attached_file・_sync_in_progressを除外）
        $existing_meta = get_post_meta($final_attachment_id);
        foreach ($existing_meta as $key => $values) {
            if (!wps_sync_is_internal_meta($key) &&
                $key !== '_wp_attachment_metadata' && 
                $key !== '_wp_attached_file') {
                delete_post_meta($final_attachment_id, $key);
            }
        }
        
        // 新しいメタデータを追加（_wp_attachment_metadata と _wp_attached_file を除外）
        foreach ($data['meta'] as $key => $value) {
            if (!wps_sync_is_internal_meta($key) && $key !== '_wp_attachment_metadata' && $key !== '_wp_attached_file') {
                update_post_meta($final_attachment_id, sanitize_key($key), $value);
            }
        }
    }
    
    // 新規・変更・欠落時のメタデータはローカルで再生成する。
    // （送信側のサムネイル参照は受信側ディスクに存在しないため使用しない）
    if (!$was_ready) {
        // 旧メタデータのサイズ参照を成功判定に使わない。
        delete_post_meta($final_attachment_id, '_wp_attachment_metadata');
        $attach_data = wp_generate_attachment_metadata($final_attachment_id, $upload['file']);
        if (!empty($attach_data)) {
            wp_update_attachment_metadata($final_attachment_id, $attach_data);
        }
    }
    if (!wps_sync_media_is_ready($final_attachment_id)) {
        return new WP_Error('media_not_ready', 'Media file or metadata is incomplete', array('status' => 500));
    }
    if (!$same_file && $old_file && is_file($old_file) && $old_file !== get_attached_file($final_attachment_id)) {
        @unlink($old_file);
    }
    
    return new WP_REST_Response(array(
        'success' => true,
        'attachment_id' => $final_attachment_id,
    ), 200);
}

/**
 * REST API: メディアの削除
 */
function wps_sync_rest_delete_media($request) {
    $attachment_id = intval($request->get_param('id'));
    
    // 無限ループ防止
    if (wps_sync_is_syncing($attachment_id)) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($attachment_id, true);
    
    // メディアを完全削除（ファイルも含む）
    wp_delete_attachment($attachment_id, true);
    
    // 同期フラグを解除
    wps_sync_set_syncing($attachment_id, false);
    
    return new WP_REST_Response(array(
        'success' => true,
    ), 200);
}

/**
 * REST API: タームの作成・更新
 */
function wps_sync_rest_term($request) {
    $data = $request->get_json_params();
    
    if (!isset($data['term_id']) || !isset($data['taxonomy'])) {
        return new WP_Error('invalid_data', 'Missing required fields', array('status' => 400));
    }
    
    $term_id = intval($data['term_id']);
    $taxonomy = sanitize_text_field($data['taxonomy']);
    
    // 無限ループ防止
    if (wps_sync_is_syncing($term_id)) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($term_id, true, 'term');
    
    // 既存のタームがあるかチェック
    $existing_term = get_term($term_id, $taxonomy);
    
    $term_data = array(
        'name' => isset($data['name']) ? sanitize_text_field($data['name']) : '',
        'slug' => isset($data['slug']) ? sanitize_title($data['slug']) : '',
        'description' => isset($data['description']) ? sanitize_textarea_field($data['description']) : '',
        'parent' => isset($data['parent']) ? intval($data['parent']) : 0,
    );
    
    if ($existing_term && !is_wp_error($existing_term)) {
        // 更新
        $result = wp_update_term($term_id, $taxonomy, $term_data);
        
        // term_taxonomy_idも更新が必要な場合
        if (isset($data['term_taxonomy_id'])) {
            $tt_id = intval($data['term_taxonomy_id']);
            $existing_tt_id = $existing_term->term_taxonomy_id;
            
            if ($tt_id > 0 && $tt_id !== $existing_tt_id) {
                // term_taxonomy_idを更新
                global $wpdb;
                $wpdb->update(
                    $wpdb->term_taxonomy,
                    array('term_taxonomy_id' => $tt_id),
                    array('term_taxonomy_id' => $existing_tt_id),
                    array('%d'),
                    array('%d')
                );
            }
        }
    } else {
        // 新規作成（ID指定）
        // WordPressの標準関数ではID指定ができないため、直接データベースに挿入
        global $wpdb;
        
        // term_idの採番を調整
        $next_id = $term_id + 1;
        $wpdb->query($wpdb->prepare(
            "ALTER TABLE {$wpdb->terms} AUTO_INCREMENT = %d",
            $next_id
        ));
        
        // タームを挿入
        $wpdb->insert(
            $wpdb->terms,
            array(
                'term_id' => $term_id,
                'name' => $term_data['name'],
                'slug' => $term_data['slug'],
                'term_group' => isset($data['term_group']) ? intval($data['term_group']) : 0,
            ),
            array('%d', '%s', '%s', '%d')
        );
        
        // term_taxonomyを挿入
        $tt_id = isset($data['term_taxonomy_id']) ? intval($data['term_taxonomy_id']) : 0;
        if ($tt_id > 0) {
            // term_taxonomy_idを指定する場合
            $wpdb->query($wpdb->prepare(
                "ALTER TABLE {$wpdb->term_taxonomy} AUTO_INCREMENT = %d",
                $tt_id + 1
            ));
            
            $wpdb->insert(
                $wpdb->term_taxonomy,
                array(
                    'term_taxonomy_id' => $tt_id,
                    'term_id' => $term_id,
                    'taxonomy' => $taxonomy,
                    'description' => $term_data['description'],
                    'parent' => $term_data['parent'],
                    'count' => 0,
                ),
                array('%d', '%d', '%s', '%s', '%d', '%d')
            );
            $final_tt_id = $tt_id;
        } else {
            // term_taxonomy_idを自動採番
            $wpdb->insert(
                $wpdb->term_taxonomy,
                array(
                    'term_id' => $term_id,
                    'taxonomy' => $taxonomy,
                    'description' => $term_data['description'],
                    'parent' => $term_data['parent'],
                    'count' => 0,
                ),
                array('%d', '%s', '%s', '%d', '%d')
            );
            $final_tt_id = $wpdb->insert_id;
        }
        
        $result = array('term_id' => $term_id, 'term_taxonomy_id' => $final_tt_id);
    }
    
    if (is_wp_error($result)) {
        wps_sync_set_syncing($term_id, false, 'term');
        return $result;
    }
    
    $final_term_id = is_array($result) ? $result['term_id'] : $term_id;
    
    // メタデータを完全置き換え
    if (isset($data['meta']) && is_array($data['meta'])) {
        // 既存のメタデータを削除
        $existing_meta = get_term_meta($final_term_id);
        foreach ($existing_meta as $key => $values) {
            if (!wps_sync_is_internal_meta($key)) {
                delete_term_meta($final_term_id, $key);
            }
        }
        
        // 新しいメタデータを追加
        foreach ($data['meta'] as $key => $value) {
            if (!wps_sync_is_internal_meta($key)) {
                update_term_meta($final_term_id, sanitize_key($key), $value);
            }
        }
    }
    
    // 同期フラグを解除
    wps_sync_set_syncing($term_id, false, 'term');
    
    return new WP_REST_Response(array(
        'success' => true,
        'term_id' => $final_term_id,
    ), 200);
}

/**
 * REST API: タームの削除
 */
function wps_sync_rest_delete_term($request) {
    $term_id = intval($request->get_param('id'));
    $taxonomy = sanitize_text_field($request->get_param('taxonomy'));
    
    // 無限ループ防止
    if (wps_sync_is_syncing($term_id, 'term')) {
        return new WP_Error('syncing', 'Already syncing', array('status' => 400));
    }
    
    // 同期フラグをセット
    wps_sync_set_syncing($term_id, true, 'term');
    
    // タームを削除
    wp_delete_term($term_id, $taxonomy);
    
    // 同期フラグを解除
    wps_sync_set_syncing($term_id, false, 'term');
    
    return new WP_REST_Response(array(
        'success' => true,
    ), 200);
}
