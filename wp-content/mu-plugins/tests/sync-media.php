<?php
/**
 * Integration regression tests against real WordPress and an isolated MySQL.
 * Run with PHP's mysqli, fileinfo and GD extensions, and a disposable MySQL
 * listening ONLY on 127.0.0.1:13307 (root with an empty password).
 * No local-site database, real gallery or external HTTP service is used.
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$root = dirname(__DIR__, 3);
$runtime = $root . '/.tmp/wps-sync-tests/run-' . bin2hex(random_bytes(4));
mkdir($runtime . '/content/mu-plugins', 0777, true);
mkdir($runtime . '/content/plugins', 0777, true);
mkdir($runtime . '/content/themes', 0777, true);
$database = 'wps_sync_test_' . bin2hex(random_bytes(4));
$connection = new mysqli('127.0.0.1', 'root', '', '', 13307);
$connection->query('CREATE DATABASE ' . $database . ' CHARACTER SET utf8mb4');

define('ABSPATH', $root . '/');
define('DB_HOST', '127.0.0.1:13307');
define('DB_NAME', $database);
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define('WP_CONTENT_DIR', $runtime . '/content');
define('WP_CONTENT_URL', 'http://sync-test.invalid/content');
define('WP_SITEURL', 'http://sync-test.invalid');
define('WP_HOME', 'http://sync-test.invalid');
define('WP_INSTALLING', true);
define('DISABLE_WP_CRON', true);
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);
define('WP_DEBUG_LOG', false);
define('SYNC_SITE_URL', 'http://receiver.invalid');
define('SYNC_AUTH_USER', 'test-admin');
define('SYNC_AUTH_PASS', 'test-only');
define('WP_TEMP_DIR', $runtime . '/');
$table_prefix = 'wp_';
$_SERVER['HTTP_HOST'] = 'sync-test.invalid';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
require ABSPATH . 'wp-settings.php';

// No request is permitted to escape the test process.
$http_handler = null;
$requests = array();
add_filter('pre_http_request', function ($pre, $args, $url) use (&$http_handler, &$requests) {
    $requests[] = array($args['method'], $url, isset($args['body']) ? json_decode($args['body'], true) : null);
    return $http_handler ? $http_handler($args, $url) : new WP_Error('test_network_blocked', 'No test HTTP handler');
}, 10, 3);
add_filter('pre_wp_mail', '__return_true');
require ABSPATH . 'wp-admin/includes/upgrade.php';
wp_install('Sync regression', 'test-admin', 'test@example.invalid', false, '', 'test-only-password');
wp_set_current_user(1);
register_post_type('gallery', array('public' => true, 'supports' => array('title', 'thumbnail')));
add_theme_support('post-thumbnails');
require dirname(__DIR__) . '/wp-sync-sites.php';
wps_sync_init();
$requests = array();

function check_sync($condition, $message) {
    if (!$condition) {
        throw new RuntimeException($message);
    }
    echo "PASS: $message\n";
}
function sync_request($body) {
    $request = new WP_REST_Request('POST');
    $request->set_header('Content-Type', 'application/json');
    $request->set_body(wp_json_encode($body));
    return $request;
}
function sync_response($body, $status = 200) {
    return array('response' => array('code' => $status, 'message' => ''), 'body' => wp_json_encode($body), 'headers' => array());
}

try {
    $image = imagecreatetruecolor(640, 480);
    imagefill($image, 0, 0, imagecolorallocate($image, 180, 120, 150));
    ob_start();
    imagepng($image);
    $png = ob_get_clean();
    imagedestroy($image);
    $media = array(
        'id' => 12449, 'post_title' => 'FOOT test', 'file_name' => 'FOOTベージュマグネットワンカラーHK.png',
        'mime_type' => 'image/png', 'file_data' => base64_encode($png),
        'post_date' => '2026-11-14 14:48:39',
        'meta' => array('_sync_started_at' => 1, '_sync_retry_attempt' => 4, '_wp_attachment_image_alt' => 'Test alt'),
    );
    $gallery = array(
        'id' => 12470, 'post_type' => 'gallery', 'post_title' => 'FOOT test gallery',
        'post_status' => 'publish', 'thumbnail_id' => 12449,
        'meta' => array('_thumbnail_id' => 12449, 'gallery_main_category' => 'guest', '_sync_retry_attempt' => 4),
    );

    $result = wps_sync_rest_post(sync_request($gallery));
    check_sync(is_wp_error($result) && $result->get_error_code() === 'missing_thumbnail' && !get_post(12470), 'Missing media rejects the post before creating a broken gallery');
    $result = wps_sync_rest_media(sync_request($media));
    check_sync(!is_wp_error($result) && $result->get_data()['attachment_id'] === 12449, 'Missing media is imported with its original ID');
    check_sync(wps_sync_media_is_ready(12449), 'Imported image has a real file and local thumbnail metadata');
    check_sync(!get_post_meta(12449, '_sync_retry_attempt', true) && !wps_sync_is_syncing(12449), 'Remote retry and lock metadata never pollute local state');
    $result = wps_sync_rest_post(sync_request($gallery));
    check_sync(!is_wp_error($result) && get_post_thumbnail_id(12470) === 12449 && get_the_post_thumbnail_url(12470, 'large'), 'Gallery renders its thumbnail after missing media is restored');
    check_sync(count($requests) === 0, 'Inbound media and post do not echo back to the sender');

    $first_file = get_attached_file(12449);
    $file_count = count(glob(dirname($first_file) . '/*'));
    $result = wps_sync_rest_media(sync_request($media));
    check_sync(!is_wp_error($result) && get_attached_file(12449) === $first_file && count(glob(dirname($first_file) . '/*')) === $file_count, 'Repeated delivery reuses the same file without creating numbered copies');

    $meta = wp_get_attachment_metadata(12449);
    $thumbnail = dirname($first_file) . '/' . $meta['sizes']['thumbnail']['file'];
    unlink($thumbnail); // Only this test's isolated upload is removed.
    check_sync(!wps_sync_media_is_ready(12449), 'Missing thumbnail file is detected even if the media record exists');
    $result = wps_sync_rest_media(sync_request($media));
    check_sync(!is_wp_error($result) && is_file($thumbnail), 'Re-delivery regenerates a missing thumbnail');

    $bad_media = array_replace($media, array('file_data' => 'not-base64!'));
    $result = wps_sync_rest_media(sync_request($bad_media));
    check_sync(is_wp_error($result) && is_file($first_file) && !wps_sync_is_syncing(12449), 'Invalid payload preserves the good image and releases its lock');
    add_filter('wp_insert_post_empty_content', '__return_true');
    try {
        $result = wps_sync_rest_media(sync_request($media));
        check_sync(is_wp_error($result) && get_attached_file(12449) === $first_file && wps_sync_media_is_ready(12449), 'Database write failure during re-delivery preserves the existing image');
    } finally {
        remove_filter('wp_insert_post_empty_content', '__return_true');
    }
    check_sync(!wps_sync_is_syncing(12449), 'Database write failure releases the media lock');
    $result = wps_sync_rest_media(sync_request(array_replace($media, array('id' => 12470))));
    check_sync(is_wp_error($result) && $result->get_error_code() === 'id_conflict' && get_post_type(12470) === 'gallery', 'Media ID collision cannot overwrite a gallery');

    // Reproduce the original failure: source has media, receiver lacks it.
    $requests = array();
    $http_handler = function ($args, $url) {
        if ($args['method'] === 'GET') {
            return sync_response(array('success' => true, 'attachment_id' => 12449, 'ready' => false));
        }
        if (str_ends_with($url, '/media')) {
            return sync_response(array('success' => true, 'attachment_id' => 12449));
        }
        return sync_response(array('success' => true, 'post_id' => 12470));
    };
    check_sync(wps_sync_post(12470, get_post(12470), true), 'Re-saving a gallery sends its missing image before sending the post');
    check_sync(array_column($requests, 0) === array('GET', 'POST', 'POST') && str_ends_with($requests[1][1], '/media') && str_ends_with($requests[2][1], '/post'), 'Transfer order is media check, image, then gallery');
    foreach ($requests as $request) {
        foreach (($request[2]['meta'] ?? array()) as $key => $value) {
            check_sync(!str_starts_with($key, '_sync_'), 'Outbound payload excludes internal state: ' . $key);
        }
    }
    check_sync(!wp_next_scheduled('wps_sync_retry', array(12449, 'media')) && !wp_next_scheduled('wps_sync_retry', array(12470, 'post')), 'Successful recovery clears retry jobs for image and gallery');

    $requests = array();
    $http_handler = function ($args, $url) {
        if ($args['method'] === 'GET') {
            return sync_response(array('success' => true, 'attachment_id' => 12449, 'ready' => false));
        }
        return new WP_Error('http_request_failed', 'Simulated connection failure');
    };
    check_sync(!wps_sync_post(12470, get_post(12470), true), 'Connection failure is not reported as sync success');
    check_sync(count($requests) === 3 && !str_ends_with($requests[2][1], '/post'), 'Failed image transfer never sends the gallery prematurely');
    $post_retry = wp_next_scheduled('wps_sync_retry', array(12470, 'post'));
    check_sync($post_retry && wp_next_scheduled('wps_sync_retry', array(12449, 'media')), 'Failed media and gallery are both queued for delayed retry');
    wps_sync_schedule_retry(12470, 'post');
    check_sync(wp_next_scheduled('wps_sync_retry', array(12470, 'post')) === $post_retry, 'Repeated failures do not duplicate or postpone a pending retry');

    $requests = array();
    $http_handler = function ($args, $url) {
        if ($args['method'] === 'GET') {
            return sync_response(array('success' => true, 'attachment_id' => 12449, 'ready' => true));
        }
        return sync_response(array('success' => true, 'post_id' => 12470));
    };
    remove_action('save_post', 'wps_sync_post', 10);
    wp_update_post(array('ID' => 12470, 'post_title' => 'Latest title'));
    add_action('save_post', 'wps_sync_post', 10, 3);
    wp_unschedule_event($post_retry, 'wps_sync_retry', array(12470, 'post'));
    do_action('wps_sync_retry', 12470, 'post');
    check_sync($requests[1][2]['post_title'] === 'Latest title' && count($requests) === 2, 'Cron retries the latest post and skips re-uploading a healthy image');
    check_sync(!wp_next_scheduled('wps_sync_retry', array(12470, 'post')), 'Successful Cron retry clears the scheduled job');

    $media_retry = wp_next_scheduled('wps_sync_retry', array(12449, 'media'));
    $http_handler = function () { return sync_response(array('success' => true, 'attachment_id' => 999)); };
    check_sync(!wps_sync_media(12449) && wp_next_scheduled('wps_sync_retry', array(12449, 'media')), 'HTTP 200 with the wrong media ID does not discard the retry');
    $http_handler = function () { return sync_response(array('success' => true, 'attachment_id' => 12449)); };
    wp_unschedule_event($media_retry, 'wps_sync_retry', array(12449, 'media'));
    do_action('wps_sync_retry', 12449, 'media');
    check_sync(!wp_next_scheduled('wps_sync_retry', array(12449, 'media')), 'Delayed media retry clears its job after confirmed success');

    $requests = array();
    $http_handler = function () { return sync_response(array('code' => 'syncing'), 400); };
    check_sync(!wps_sync_post(12470, get_post(12470), true) && count($requests) === 1 && wp_next_scheduled('wps_sync_retry', array(12470, 'post')), 'Busy receiver defers the gallery instead of dropping it or uploading over an active sync');
    wps_sync_clear_retry(12470, 'post');

    $requests = array();
    wps_sync_schedule_retry(999999, 'post');
    do_action('wps_sync_retry', 999999, 'post');
    check_sync(!wp_next_scheduled('wps_sync_retry', array(999999, 'post')) && !$requests, 'Retry for a deleted object is cancelled without recreating it');

    wps_sync_set_syncing(12449, true);
    check_sync(wps_sync_is_syncing(12449), 'Active lock blocks re-entrant sync');
    update_post_meta(12449, '_sync_started_at', time() - 601);
    check_sync(!wps_sync_is_syncing(12449), 'Lock left by interrupted PHP expires after ten minutes');
    update_post_meta(12449, '_sync_in_progress', '1');
    check_sync(wps_sync_is_syncing(12449) && get_post_meta(12449, '_sync_started_at', true), 'Legacy lock acquires an expiry instead of blocking forever');
    wps_sync_set_syncing(12449, false);

    $throw = function () { throw new RuntimeException('Simulated receiver failure'); };
    add_filter('wp_insert_post_data', $throw);
    try {
        wps_sync_rest_post(sync_request($gallery));
        throw new RuntimeException('Expected receiver exception');
    } catch (RuntimeException $error) {
        check_sync($error->getMessage() === 'Simulated receiver failure', 'Receiver exception was injected');
    } finally {
        remove_filter('wp_insert_post_data', $throw);
    }
    check_sync(!wps_sync_is_syncing(12470), 'Receiver exception always releases the post lock');

    $routes = rest_get_server()->get_routes();
    $methods = array();
    foreach ($routes['/sync/v1/media/(?P<id>\d+)'] as $route) {
        $methods = array_merge($methods, array_keys($route['methods']));
    }
    check_sync(in_array('GET', $methods, true) && in_array('DELETE', $methods, true), 'Media health route coexists with the existing delete route');
    echo "All sync regression checks passed.\n";
} catch (Throwable $error) {
    fwrite(STDERR, $error . "\n");
    $failed = true;
} finally {
    $connection->query('DROP DATABASE ' . $database);
    $connection->close();
}
exit(empty($failed) ? 0 : 1);
