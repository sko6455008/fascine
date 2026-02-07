<?php
/**
 * Template Name: Menu Page
 * Description: Template for the Menu/Pricing page
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/menu.webp);">
    <div class="overlay-main site-bg-secondary opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Menu</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Menu</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<?php get_template_part('template-parts/home/menu-section'); ?>

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>