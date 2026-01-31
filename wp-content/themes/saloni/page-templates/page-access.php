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
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6309.495304446196!2d-122.43885472228101!3d37.74906395235639!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f7e12a1d66d03%3A0xb8c905ae4e81369b!2sQ-Architecture!5e0!3m2!1sen!2sin!4v1623689156327!5m2!1sen!2sin"
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
                                <div>Contact info</div>
                                <div class="sep-leaf-right"><img
                                        src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                            </div>
                            <h2 data-title="Info">Our Full Info</h2>
                        </div>
                        <!-- TITLE END-->

                        <div class="contact-info-section text-black">

                            <div class="row">

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left m-b30">

                                        <div class="icon-content">
                                            <h4 class="m-t0">Phone number</h4>
                                            <p>(+291) 0987 654 321</p>
                                            <p>(+291) 0987 654 123</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left m-b30">

                                        <div class="icon-content">
                                            <h4 class="m-t0">Email address</h4>
                                            <p>thewebmax@gmail.com</p>
                                            <p>thewebmaxhelp@gmail.com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left m-b30">

                                        <div class="icon-content">
                                            <h4 class="m-t0">Address info</h4>
                                            <p>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="wt-icon-box-wraper left">

                                        <div class="icon-content">
                                            <h4 class="m-t0">Opening Hours</h4>
                                            <ul class="list-unstyled m-b0">
                                                <li>Mon-Fri: 9 am – 6 pm</li>
                                                <li>Saturday: 9 am – 4 pm</li>
                                                <li>Sunday: Closed</li>
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