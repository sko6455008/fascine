<?php
/**
 * Header template
 *
 * @package Saloni
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- META -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FAVICONS ICON -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="page-wraper">

        <!-- HEADER START -->
        <header class="site-header header-style-1 mobile-sider-drawer-menu header-fullwidth">

            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar">
                    <!-- Flex Container for Left/Center/Right Layout -->
                    <div class="header-inner-wrapper">

                        <!-- LEFT: Hamburger Menu -->
                        <div class="header-left">
                            <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse"
                                type="button" class="navbar-toggler hamburger-always-visible collapsed">
                                <span class="sr-only">
                                    <?php esc_html_e('Toggle navigation', 'saloni'); ?>
                                </span>
                                <span class="icon-bar icon-bar-first"></span>
                                <span class="icon-bar icon-bar-two"></span>
                                <span class="icon-bar icon-bar-three"></span>
                            </button>
                        </div>

                        <!-- CENTER: Logo -->
                        <div class="header-center">
                            <div class="logo-header">
                                <div class="logo-header-inner logo-header-one">
                                    <a href="<?php echo esc_url(home_url('/')); ?>">
                                        <?php if (has_custom_logo()): ?>
                                            <?php the_custom_logo(); ?>
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo-dark.png"
                                                alt="<?php bloginfo('name'); ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT: Instagram + Contact Button -->
                        <div class="header-right">
                            <div class="header-buttons">
                                <!-- Instagram Button -->
                                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                                    class="header-icon-btn instagram-btn">
                                    <i class="fab fa-instagram"></i>
                                    <span>Instagram</span>
                                </a>
                                <!-- Contact Button -->
                                <a href="<?php echo esc_url(home_url('/access/')); ?>"
                                    class="header-action-btn contact-btn">
                                    <i class="fas fa-envelope"></i>
                                    <span><?php esc_html_e('お問い合わせ', 'saloni'); ?></span>
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- MOBILE NAV DRAWER -->
                    <div class="nav-animation header-nav collapse">

                        <!-- Close Button -->
                        <button class="nav-close-btn" type="button">
                            <i class="fa fa-times"></i>
                        </button>

                        <?php
                        if (has_nav_menu('primary')) {
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => 'nav navbar-nav',
                                'container' => false,
                                'walker' => new Saloni_Walker_Nav_Menu(),
                            ));
                        } else {
                            // Fallback menu based on header.html
                            ?>
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                                <li><a href="<?php echo esc_url(home_url('/concept/')); ?>">Concept</a></li>
                                <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>">Gallery</a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a>
                                </li>
                                <li><a href="<?php echo esc_url(home_url('/menu/')); ?>">Menu</a></li>
                                <li><a href="<?php echo esc_url(home_url('/qa/')); ?>">Q&A</a></li>
                                <li><a href="<?php echo esc_url(home_url('/access/')); ?>">Access</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Overlay -->
                    <div class="nav-overlay"></div>

                </div>
            </div>

        </header>
        <!-- HEADER END -->

        <!-- CONTENT START -->
        <div class="page-content">