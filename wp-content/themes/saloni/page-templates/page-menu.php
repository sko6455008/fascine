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
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/2.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
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

<!-- PRICING SECTION START -->
<div class="section-full p-t80 p-b50 bg-orange-light bg-brush-img">
    <div class="container">
        <div class="section-content">

            <!-- TITLE START-->
            <div class="center wt-small-separator-outer section-head">
                <div class="wt-small-separator">
                    <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt="">
                    </div>
                    <div>Cutting and styling</div>
                    <div class="sep-leaf-right"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt="">
                    </div>
                </div>
                <h2 data-title="Pricing">Our Pricing</h2>
            </div>
            <!-- TITLE END-->

            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-12 col-sm-12 m-b30">

                    <div class="pricing-list-block bg-white p-a20">
                        <div class="pricing-list-img p-b10"><img
                                src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt=""></div>
                        <ul>
                            <li>
                                <div class="price-list-info">
                                    <h3>Ombré Color </h3>
                                    <p>We have a passion for promoting healthy</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">35</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Hair cut with Blow dry</h3>
                                    <p>Step up your healthy hair care routine with tips</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">25</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Blow Dry & Curl</h3>
                                    <p>Take a peek at a little sample of what we are best.</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">15</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Shampoo & Set</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">40</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Color & highlights</h3>
                                    <p>Cutting and styling with cruelty free luxury brands</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">45</span></h3>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 m-b30">
                    <div class="pricing-list-block bg-white p-a20">
                        <div class="pricing-list-img p-b10"><img
                                src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt=""></div>
                        <ul>
                            <li>
                                <div class="price-list-info">
                                    <h3>Shampoo & Set</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">40</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Color & highlights</h3>
                                    <p>Cutting and styling with cruelty free luxury brands</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">45</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Ombré Color </h3>
                                    <p>We have a passion for promoting healthy</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">35</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Hair cut with Blow dry</h3>
                                    <p>Step up your healthy hair care routine with tips</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">25</span></h3>
                                </div>
                            </li>
                            <li>
                                <div class="price-list-info">
                                    <h3>Blow Dry & Curl</h3>
                                    <p>Take a peek at a little sample of what we are best.</p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-sign">$</span><span
                                            class="amount-price">15</span></h3>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- PRICING SECTION END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>