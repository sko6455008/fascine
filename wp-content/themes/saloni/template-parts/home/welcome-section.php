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
                            <?php esc_html_e('池袋駅近くにある、木目を基調とした落ち着いた雰囲気', 'saloni'); ?>
                        </h2>
                        <!-- TITLE END-->
                        <p>
                            <?php esc_html_e('爪を削らない、地爪に優しい実力派サロン。 池袋西口で叶える、最先端の韓国・ワンホンデザイン。 丁寧なフィルインとケアで「圧倒的なモチ」を実現。ゆったり寛げる木目調の空間で、理想の持ち込みデザインも大歓迎です。', 'saloni'); ?>
                        </p>

                        <div class="welcom-to-section-bottom d-flex justify-content-between">
                            <div class="welcom-btn-position m-t20">
                                <a href="<?php echo esc_url(home_url('/concept/')); ?>"
                                    class="site-button site-btn-effect">
                                    <?php esc_html_e('More Concept', 'saloni'); ?>
                                </a>
                            </div>
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
                    <div class="img-colarge-single">
                        <img src="<?php echo $theme_uri; ?>/images/access.webp" alt="" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT SECTION END -->