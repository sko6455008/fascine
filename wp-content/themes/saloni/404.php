<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper" style="background-image:url(<?php echo $theme_uri; ?>/images/banner/9.jpg);">
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer text-center">
                <div class="banner-title-name">
                    <h2 class="wt-title">
                        <?php esc_html_e('404 - Page Not Found', 'saloni'); ?>
                    </h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php esc_html_e('Home', 'saloni'); ?>
                        </a></li>
                    <li>
                        <?php esc_html_e('404', 'saloni'); ?>
                    </li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- 404 CONTENT -->
<div class="section-full p-t80 p-b50 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="error-404-wrap">
                    <h1 class="error-title" style="font-size: 150px; color: #b89e6e;">404</h1>
                    <h2>
                        <?php esc_html_e('Oops! Page Not Found', 'saloni'); ?>
                    </h2>
                    <p class="m-b30">
                        <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'saloni'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-button site-btn-effect">
                        <?php esc_html_e('Go Back Home', 'saloni'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 404 CONTENT END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>