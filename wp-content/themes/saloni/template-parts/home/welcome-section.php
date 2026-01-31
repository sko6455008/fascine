<?php
/**
 * Welcome Section Template Part
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();
?>

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
                                <div>
                                    <?php esc_html_e('Welcome to', 'saloni'); ?>
                                </div>
                                <div class="sep-leaf-right"><img
                                        src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                            </div>
                        </div>
                        <h2>
                            <?php esc_html_e('Our Salon is Most Popular, Clean and Recommended Hair Salon', 'saloni'); ?>
                        </h2>
                        <!-- TITLE END-->
                        <p>
                            <?php esc_html_e('We have a passion for promoting healthy, balanced and beautiful living. Offering massage, Acupuncture, Laser Skincare, fitness classes and more, we emphasize preventive care, stress management, and personal growth. While you may find a visit with us to be a spa-like, relaxing and pampering experience,', 'saloni'); ?>
                        </p>

                        <div class="welcom-to-section-bottom d-flex justify-content-between">
                            <div class="welcom-btn-position m-t20"><a
                                    href="<?php echo esc_url(home_url('/concept/')); ?>"
                                    class="site-button site-btn-effect">
                                    <?php esc_html_e('More Concept', 'saloni'); ?>
                                </a></div>
                            <img src="<?php echo $theme_uri; ?>/images/sign.png" alt="">
                        </div>
                        <div class="hilite-large-title">
                            <span>
                                <?php esc_html_e('Welcome', 'saloni'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="img-colarge">
                        <div class="colarge-1"><img src="<?php echo $theme_uri; ?>/images/colarge/s1.jpg" alt=""></div>
                        <div class="colarge-2"><img src="<?php echo $theme_uri; ?>/images/colarge/s2.jpg" alt=""></div>
                        <div class="colarge-3 slide-right"><img src="<?php echo $theme_uri; ?>/images/colarge/s3.jpg"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT SECTION END -->