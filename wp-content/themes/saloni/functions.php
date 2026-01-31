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
