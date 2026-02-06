<?php
/**
 * Template Name: Access Page
 * Description: Template for the Access/Contact page
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/5.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Access</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Access</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- SECTION CONTENT START -->
<div class="section-full p-t80">

    <!-- LOCATION BLOCK-->
    <div class="section-content">
        <div class="gmap-outline">
            <iframe
                src="https://maps.google.com/maps?q=%E3%83%95%E3%82%A1%E3%83%83%E3%82%B7%E3%83%BC%E3%83%8A%E6%B1%A0%E8%A2%8B%E3%83%8D%E3%82%A4%E3%83%AB%E3%82%B5%E3%83%AD%E3%83%B3%E3%83%BB%E3%83%91%E3%83%A9%E3%82%B8%E3%82%A7%E3%83%AB%E5%B0%82%E9%96%80%E5%BA%97&t=m&z=16&output=embed&iwloc=near"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>


</div>

<!-- GOOGLE MAP -->
<div class="section-full p-t80 p-b80 bg-orange-light">
    <div class="section-content">
        <div class="container">
            <div class="contact-one">

                <div class="contact-info m-t30">
                    <div class="contact-info-inner">

                        <!-- TITLE START-->
                        <div class="center wt-small-separator-outer section-head">
                            <div class="wt-small-separator">
                                <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png"
                                        alt=""></div>
                                <div>Infomation</div>
                                <div class="sep-leaf-right"><img
                                        src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                            </div>
                            <h2 data-title="Access">Access</h2>
                        </div>
                        <!-- TITLE END-->

                        <div class="contact-info-section text-black">

                            <div class="row">

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left m-b30">

                                        <div class="icon-content">
                                            <h4 class="m-t0">電話番号</h4>
                                            <p>050-5305-3298</p>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left m-b30">

                                        <div class="icon-content">
                                            <h4 class="m-t0">Email</h4>
                                            <p>thewebmax@gmail.com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left m-b30">

                                        <div class="icon-content">
                                            <h4 class="m-t0">住所</h4>
                                            <p>東京都豊島区池袋2-40-13 VORT池袋ビル 3F</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left">

                                        <div class="icon-content">
                                            <h4 class="m-t0">営業時間</h4>
                                            <ul class="list-unstyled m-b0">
                                                <li>平日：11：00 〜 21:00</li>
                                                <li>土日祝：10：00 〜 20:00</li>
                                            </ul>
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
</div>
<!-- SECTION CONTENT END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>