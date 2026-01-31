<?php
/**
 * Template Name: Concept Page
 * Description: Template for the Concept page
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/3.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Concept</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Concept</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- ABOUT SECTION START -->
<div class="section-full welcome-section-outer">
    <div class="welcome-section-top shadow-lg bg-white p-tb80">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="welcom-to-section">
                        <!-- TITLE START-->
                        <div class="left wt-small-separator-outer">
                            <div class="wt-small-separator">
                                <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png"
                                        alt=""></div>
                                <div>Welcome to</div>
                                <div class="sep-leaf-right"><img
                                        src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                            </div>
                        </div>
                        <h2>Our Salon is Most Popular, Clean and Recommended Hair Salon</h2>
                        <!-- TITLE END-->
                        <p>We have a passion for promoting healthy, balanced and beautiful living. Offering massage,
                            Acupuncture, Laser Skincare, fitness classes and more, we emphasize preventive care, stress
                            management, and personal growth. While you may find a visit with us to be a spa-like,
                            relaxing and pampering experience, </p>

                        <div class="welcom-to-section-bottom d-flex justify-content-between">
                            <div class="welcom-btn-position m-t20"><a
                                    href="<?php echo esc_url(home_url('/access/')); ?>"
                                    class="site-button site-btn-effect">More Concept</a></div>
                            <img src="<?php echo $theme_uri; ?>/images/sign.png" alt="">
                        </div>
                        <div class="hilite-large-title">
                            <span>Welcome</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="img-colarge">
                        <div class="colarge-1"><img src="<?php echo $theme_uri; ?>/images/colarge/s1.jpg" alt=""></div>
                        <div class="colarge-2"><img src="<?php echo $theme_uri; ?>/images/colarge/s2.jpg" alt=""></div>
                        <div class="colarge-3"><img src="<?php echo $theme_uri; ?>/images/colarge/s3.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="welcome-section-bottom overlay-wraper bg-cover bg-no-repeat"
        style="background-image:url(<?php echo $theme_uri; ?>/images/background/bg-2.jpg);">
        <div class="overlay-main bg-orange-light opacity-09"></div>
        <div class="container welcome-section-bottom-space p-t80 p-b50">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="video-section-outer mfp-gallery">
                        <!--Fade slider-->
                        <div class="owl-carousel home-video-slider owl-btn-top-left light-next-prev m-b30">

                            <div class="item">
                                <div class="video-section">
                                    <img src="<?php echo $theme_uri; ?>/images/gallery/pic1.jpg" alt="">
                                    <a href="https://player.vimeo.com/video/34741214?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0"
                                        class="mfp-video play-now">
                                        <i class="icon fa fa-play"></i>
                                        <span class="ripple"></span>
                                    </a>
                                </div>
                            </div>

                            <div class="item">
                                <div class="video-section">
                                    <img src="<?php echo $theme_uri; ?>/images/gallery/pic2.jpg" alt="">
                                </div>
                            </div>

                            <div class="item">
                                <div class="video-section">
                                    <img src="<?php echo $theme_uri; ?>/images/gallery/pic1.jpg" alt="">
                                    <a href="https://player.vimeo.com/video/34741214?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0"
                                        class="mfp-video play-now">
                                        <i class="icon fa fa-play"></i>
                                        <span class="ripple"></span>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!--fade slider END-->
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="about-section-outer">
                        <!-- TITLE START-->
                        <div class="left wt-small-separator-outer">
                            <div class="wt-small-separator">
                                <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png"
                                        alt=""></div>
                                <div>Welcome to</div>
                                <div class="sep-leaf-right"><img
                                        src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                            </div>
                        </div>
                        <h2>Our Video Presentation</h2>
                        <!-- TITLE END-->

                        <p>Professional stylist tell me how beautiful it is to hide or emphasize your image. the beauty
                            lies in the details of trends, the choice of fabrics and colors. guarantee
                            you a unique result. We will provide you with the highest quality of our service</p>

                        <div class="counter-outer p-t10">

                            <div class="row justify-content-center">

                                <div class="col-lg-4 col-md-4 m-b30">
                                    <div class="wt-icon-box-wraper center bg-no-repeat bg-top-center"
                                        style="background-image:url(<?php echo $theme_uri; ?>/images/background/count-bg.png);">
                                        <h2 class="counter site-text-secondry">23</h2>
                                        <span class="site-text-secondry title-style-2">Awards</span>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 m-b30">
                                    <div class="wt-icon-box-wraper center bg-no-repeat bg-top-center"
                                        style="background-image:url(<?php echo $theme_uri; ?>/images/background/count-bg.png);">
                                        <h2 class="counter site-text-secondry">14</h2>
                                        <span class="site-text-secondry title-style-2">Years</span>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 m-b30">
                                    <div class="wt-icon-box-wraper center bg-no-repeat bg-top-center"
                                        style="background-image:url(<?php echo $theme_uri; ?>/images/background/count-bg.png);">
                                        <h2 class="counter site-text-secondry">26</h2>
                                        <span class="site-text-secondry title-style-2">Experts</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT SECTION END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>