<?php
/**
 * Saloni Theme Functions
 *
 * @package Saloni
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function saloni_setup()
{
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'saloni'),
        'footer' => __('Footer Menu', 'saloni'),
    ));
}
add_action('after_setup_theme', 'saloni_setup');

/**
 * Enqueue scripts and styles
 */
function saloni_scripts()
{
    $theme_uri = get_template_directory_uri();

    // Stylesheets
    wp_enqueue_style('bootstrap', $theme_uri . '/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_style('font-awesome', $theme_uri . '/css/font-awesome.min.css', array(), '6.0.0');
    wp_enqueue_style('owl-carousel', $theme_uri . '/css/owl.carousel.min.css', array(), '2.3.4');
    wp_enqueue_style('bootstrap-select', $theme_uri . '/css/bootstrap-select.min.css', array(), '1.13.0');
    wp_enqueue_style('magnific-popup', $theme_uri . '/css/magnific-popup.min.css', array(), '1.1.0');
    wp_enqueue_style('loader', $theme_uri . '/css/loader.min.css', array(), '1.0.0');
    wp_enqueue_style('saloni-main', $theme_uri . '/css/style.css', array(), '1.0.0');
    wp_enqueue_style('saloni-custom', $theme_uri . '/css/custom.css', array('saloni-main'), '1.0.0');

    // Revolution Slider CSS
    wp_enqueue_style('revolution-settings', $theme_uri . '/plugins/revolution/revolution/css/settings.css', array(), '5.4.0');
    wp_enqueue_style('revolution-navigation', $theme_uri . '/plugins/revolution/revolution/css/navigation.css', array(), '5.4.0');

    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Yeseva+One|Caveat:400,700|Poppins&display=swap', array(), null);

    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper', $theme_uri . '/js/popper.min.js', array('jquery'), '2.11.0', true);
    wp_enqueue_script('bootstrap', $theme_uri . '/js/bootstrap.min.js', array('jquery', 'popper'), '5.3.0', true);
    wp_enqueue_script('bootstrap-select', $theme_uri . '/js/bootstrap-select.min.js', array('jquery', 'bootstrap'), '1.13.0', true);
    wp_enqueue_script('magnific-popup', $theme_uri . '/js/magnific-popup.min.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('waypoints', $theme_uri . '/js/waypoints.min.js', array('jquery'), '4.0.1', true);
    wp_enqueue_script('counterup', $theme_uri . '/js/counterup.min.js', array('jquery', 'waypoints'), '2.1.0', true);
    wp_enqueue_script('waypoints-sticky', $theme_uri . '/js/waypoints-sticky.min.js', array('jquery', 'waypoints'), '4.0.1', true);
    wp_enqueue_script('isotope', $theme_uri . '/js/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
    wp_enqueue_script('imagesloaded', $theme_uri . '/js/imagesloaded.pkgd.min.js', array('jquery'), '5.0.0', true);
    wp_enqueue_script('owl-carousel', $theme_uri . '/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
    wp_enqueue_script('theia-sticky-sidebar', $theme_uri . '/js/theia-sticky-sidebar.js', array('jquery'), '1.7.0', true);
    wp_enqueue_script('saloni-custom', $theme_uri . '/js/custom.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('saloni-custom-header', $theme_uri . '/js/custom-header.js', array('jquery'), '1.0.0', true);

    // Revolution Slider Scripts (only on front page)
    if (is_front_page() || is_page_template('page-templates/page-home.php')) {
        wp_enqueue_script('themepunch-tools', $theme_uri . '/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js', array('jquery'), '5.4.0', true);
        wp_enqueue_script('themepunch-revolution', $theme_uri . '/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js', array('jquery', 'themepunch-tools'), '5.4.0', true);
        wp_enqueue_script('revolution-plugin', $theme_uri . '/plugins/revolution/revolution/js/extensions/revolution-plugin.js', array('themepunch-revolution'), '5.4.0', true);
        wp_enqueue_script('rev-script', $theme_uri . '/js/rev-script-2.js', array('revolution-plugin'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'saloni_scripts');

/**
 * Register widget area
 */
function saloni_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'saloni'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'saloni'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer', 'saloni'),
        'id' => 'footer-1',
        'description' => __('Add widgets here to appear in your footer.', 'saloni'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'saloni_widgets_init');

/**
 * Custom nav walker for primary menu
 */
class Saloni_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Theme customizer settings
 */
function saloni_customize_register($wp_customize)
{
    // Footer Section
    $wp_customize->add_section('saloni_footer', array(
        'title' => __('Footer Settings', 'saloni'),
        'priority' => 120,
    ));

    // Footer Description
    $wp_customize->add_setting('saloni_footer_description', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adip iscing elit, sed do eiusmod temporin cididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.eiusmod tempo.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('saloni_footer_description', array(
        'label' => __('Footer Description', 'saloni'),
        'section' => 'saloni_footer',
        'type' => 'textarea',
    ));

    // Address
    $wp_customize->add_setting('saloni_address', array(
        'default' => 'San Francisco City Hall, San Francisco, CA',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('saloni_address', array(
        'label' => __('Address', 'saloni'),
        'section' => 'saloni_footer',
        'type' => 'text',
    ));

    // Phone
    $wp_customize->add_setting('saloni_phone', array(
        'default' => '(654) 321-7654',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('saloni_phone', array(
        'label' => __('Phone Number', 'saloni'),
        'section' => 'saloni_footer',
        'type' => 'text',
    ));

    // Social Media Section
    $wp_customize->add_section('saloni_social', array(
        'title' => __('Social Media', 'saloni'),
        'priority' => 125,
    ));

    // Instagram URL
    $wp_customize->add_setting('saloni_instagram', array(
        'default' => 'https://www.instagram.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('saloni_instagram', array(
        'label' => __('Instagram URL', 'saloni'),
        'section' => 'saloni_social',
        'type' => 'url',
    ));

    // Copyright Text
    $wp_customize->add_setting('saloni_copyright', array(
        'default' => 'Copyright © ' . date('Y') . ' Thewebmax',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('saloni_copyright', array(
        'label' => __('Copyright Text', 'saloni'),
        'section' => 'saloni_footer',
        'type' => 'text',
    ));
}
add_action('customize_register', 'saloni_customize_register');

/**
 * Helper function to get theme mod with default
 */
function saloni_get_option($key, $default = '')
{
    return get_theme_mod($key, $default);
}

/**
 * Custom comment callback
 */
function saloni_comment_callback($comment, $args, $depth)
{
    ?>
    <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment, 60); ?>
                <cite class="fn"><?php echo get_comment_author_link(); ?></cite>
                <span class="comment-date"><?php echo get_comment_date(); ?></span>
            </div>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <div class="reply">
                <?php
                comment_reply_link(array_merge($args, array(
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'before' => '<span class="reply-btn">',
                    'after' => '</span>',
                )));
                ?>
            </div>
        </div>
        <?php
}

/**
 * Modify excerpt length
 */
function saloni_excerpt_length($length)
{
    return 25;
}
add_filter('excerpt_length', 'saloni_excerpt_length');

/**
 * Modify excerpt more
 */
function saloni_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'saloni_excerpt_more');

/**
 * ========================================
 * ギャラリー関連機能
 * ========================================
 */

/**
 * カスタム投稿タイプ: ギャラリー
 */
function saloni_register_gallery_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'ギャラリー',
        'labels' => array(
            'name' => 'ギャラリー',
            'singular_name' => 'ギャラリー',
            'add_new' => '新規追加',
            'add_new_item' => '新規ギャラリーを追加',
            'edit_item' => 'ギャラリーを編集',
        ),
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'menu_icon' => 'dashicons-format-gallery',
        'has_archive' => true,
        'rewrite' => array('slug' => 'gallery'),
    );
    register_post_type('gallery', $args);
}
add_action('init', 'saloni_register_gallery_post_type');

/**
 * カスタム投稿タイプ: コース（サブカテゴリー管理用）
 */
function saloni_register_course_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'コース',
        'labels' => array(
            'name' => 'コース',
            'singular_name' => 'コース',
            'add_new' => '新規追加',
            'add_new_item' => '新規コースを追加',
            'edit_item' => 'コースを編集',
        ),
        'supports' => array('title', 'page-attributes'),
        'menu_icon' => 'dashicons-category',
        'has_archive' => false,
        'publicly_queryable' => false,
    );
    register_post_type('course', $args);
}
add_action('init', 'saloni_register_course_post_type');

/**
 * コース選択肢を取得する関数
 */
function fascina_get_course_choices($main_category) {
    $choices = array();
    
    $courses = get_posts(array(
        'post_type' => 'course',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'course_main_category',
                'value' => $main_category,
                'compare' => '='
            )
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
   
    foreach ($courses as $course) {
        $course_name = get_field('course_name', $course->ID);
        $course_slug = get_field('course_slug', $course->ID);
        $choices[$course_slug] = $course_name;
    }
   
    return $choices;
}

/**
 * サブカテゴリー名を取得する関数
 */
function fascina_get_sub_category_name($main_category, $sub_category) {
    $choices = fascina_get_course_choices($main_category);
    return isset($choices[$sub_category]) ? $choices[$sub_category] : $sub_category;
}

/**
 * メインカテゴリー名を取得する関数
 */
function fascina_get_main_category_name($main_category) {
    $categories = array(
        'hand' => 'Hand Design',
        'foot' => 'Foot Design',
        'guest' => 'Guest Gallery',
        'arts-parts' => 'Arts & Parts'
    );
    return isset($categories[$main_category]) ? $categories[$main_category] : $main_category;
}

/**
 * ギャラリーページ用の投稿取得
 */
function fascina_get_gallery_page_posts($main_category, $sub_category = '', $posts_per_page = 50, $paged = 1) {
    $meta_query = array(
        array(
            'key' => 'gallery_main_category',
            'value' => $main_category,
            'compare' => '='
        )
    );
    
    if (!empty($sub_category) && $sub_category !== 'list') {
        $meta_query[] = array(
            'key' => 'gallery_sub_category',
            'value' => $sub_category,
            'compare' => '='
        );
    }
    
    $args = array(
        'post_type' => 'gallery',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => $meta_query
    );
    
    return new WP_Query($args);
}

/**
 * NEWタグを表示するかどうかを判定
 */
function fascina_should_show_new_tag($post_id) {
    $post_date = get_the_date('Y-m-d', $post_id);
    $days_ago = strtotime('-14 days');
    return strtotime($post_date) >= $days_ago;
}

/**
 * NEWタグのHTMLを取得
 */
function fascina_get_new_tag_html() {
    return '<div class="new-tag-wrapper"><span class="new-tag">NEW</span></div>';
}

/**
 * カスタムリライトルールを追加
 */
function saloni_gallery_rewrite_rules() {
    // Hand Design
    add_rewrite_rule(
        '^gallery_hand_design/?$',
        'index.php?pagename=gallery&gallery_main_category=hand',
        'top'
    );
    add_rewrite_rule(
        '^gallery_hand_design/([^/]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=hand&gallery_sub_category=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^gallery_hand_design/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=hand&gallery_sub_category=$matches[1]&paged=$matches[2]',
        'top'
    );
    
    // Foot Design
    add_rewrite_rule(
        '^gallery_foot_design/?$',
        'index.php?pagename=gallery&gallery_main_category=foot',
        'top'
    );
    add_rewrite_rule(
        '^gallery_foot_design/([^/]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=foot&gallery_sub_category=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^gallery_foot_design/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=foot&gallery_sub_category=$matches[1]&paged=$matches[2]',
        'top'
    );
    
    // Guest Gallery
    add_rewrite_rule(
        '^gallery_guest_nail/?$',
        'index.php?pagename=gallery&gallery_main_category=guest',
        'top'
    );
    add_rewrite_rule(
        '^gallery_guest_nail/([^/]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=guest&gallery_sub_category=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^gallery_guest_nail/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=guest&gallery_sub_category=$matches[1]&paged=$matches[2]',
        'top'
    );
    
    // Arts & Parts
    add_rewrite_rule(
        '^gallery_arts_parts/?$',
        'index.php?pagename=gallery&gallery_main_category=arts-parts',
        'top'
    );
    add_rewrite_rule(
        '^gallery_arts_parts/([^/]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=arts-parts&gallery_sub_category=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^gallery_arts_parts/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=gallery&gallery_main_category=arts-parts&gallery_sub_category=$matches[1]&paged=$matches[2]',
        'top'
    );
}
add_action('init', 'saloni_gallery_rewrite_rules');

/**
 * カスタムクエリ変数を登録
 */
function saloni_gallery_query_vars($vars) {
    $vars[] = 'gallery_main_category';
    $vars[] = 'gallery_sub_category';
    return $vars;
}
add_filter('query_vars', 'saloni_gallery_query_vars');

/**
 * テーマ有効化時にリライトルールをフラッシュ
 */
function saloni_flush_rewrite_rules() {
    saloni_gallery_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'saloni_flush_rewrite_rules');

/**
 * ACFフィールドの登録
 */
function saloni_register_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        // ギャラリー用フィールド
        acf_add_local_field_group(array(
            'key' => 'group_gallery_saloni',
            'title' => 'ギャラリー設定',
            'fields' => array(
                array(
                    'key' => 'field_gallery_main_category_saloni',
                    'label' => 'メインカテゴリー',
                    'name' => 'gallery_main_category',
                    'type' => 'radio',
                    'required' => 1,
                    'choices' => array(
                        'hand' => 'Handデザイン',
                        'foot' => 'Footデザイン',
                        'guest' => 'Guestデザイン',
                    ),
                    'return_format' => 'value',
                    'layout' => 'vertical'
                ),
                array(
                    'key' => 'field_gallery_sub_category_saloni',
                    'label' => 'サブカテゴリー',
                    'name' => 'gallery_sub_category',
                    'type' => 'radio',
                    'instructions' => '※ギャラリーに紐づいているサブカテゴリーを削除した場合、ギャラリーページの「一覧」にだけ表示されます。',
                    'required' => 1,
                    'choices' => array(),
                    'return_format' => 'value',
                    'layout' => 'vertical'
                ),
                array(
                    'key' => 'field_gallery_is_bridal_saloni',
                    'label' => 'ブライダルデザイン',
                    'name' => 'gallery_is_bridal',
                    'type' => 'true_false',
                    'instructions' => 'ブライダルデザインとしても登録する場合はチェックしてください',
                    'required' => 0,
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'はい',
                    'ui_off_text' => 'いいえ',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_gallery_main_category_saloni',
                                'operator' => '==',
                                'value' => 'hand',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_gallery_description_saloni',
                    'label' => '説明',
                    'name' => 'gallery_description',
                    'type' => 'textarea',
                    'instructions' => 'ギャラリーの説明を入力してください',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_gallery_display_top_saloni',
                    'label' => 'トップページに表示',
                    'name' => 'gallery_display_top',
                    'type' => 'true_false',
                    'instructions' => 'トップページに表示する場合はチェックしてください',
                    'required' => 0,
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => '表示する',
                    'ui_off_text' => '表示しない'
                ),
                array(
                    'key' => 'field_gallery_display_gallery_saloni',
                    'label' => 'ギャラリーページに表示',
                    'name' => 'gallery_display_gallery',
                    'type' => 'true_false',
                    'instructions' => 'ギャラリーページに表示する場合はチェックしてください',
                    'required' => 0,
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => '表示する',
                    'ui_off_text' => '表示しない'
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'gallery',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));

        // コース（サブカテゴリー）用フィールド
        acf_add_local_field_group(array(
            'key' => 'group_course_saloni',
            'title' => 'コース詳細',
            'fields' => array(
                array(
                    'key' => 'field_course_main_category_saloni',
                    'label' => 'メインカテゴリー',
                    'name' => 'course_main_category',
                    'type' => 'radio',
                    'required' => 1,
                    'choices' => array(
                        'hand' => 'Handデザイン',
                        'foot' => 'Footデザイン',
                        'guest' => 'Guestデザイン',
                    ),
                    'return_format' => 'value',
                    'layout' => 'vertical'
                ),
                array(
                    'key' => 'field_course_name_saloni',
                    'label' => 'コース名',
                    'name' => 'course_name',
                    'type' => 'text',
                    'instructions' => 'コース名を入力してください',
                    'required' => 1,
                    'placeholder' => '例: シンプル定額, ニュアンスM定額'
                ),
                array(
                    'key' => 'field_course_slug_saloni',
                    'label' => 'スラッグ',
                    'name' => 'course_slug',
                    'type' => 'text',
                    'required' => 1,
                    'instructions' => 'URLに使う半角英数字・ハイフンのみ',
                    'placeholder' => '例: simple, popular'
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'course',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
        ));
    }
}
add_action('acf/init', 'saloni_register_acf_fields');
