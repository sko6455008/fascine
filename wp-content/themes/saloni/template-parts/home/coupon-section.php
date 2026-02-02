<?php
/**
 * Coupon Section Template Part
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();

// クーポンを取得（トップページ表示用、最大6件）
$coupon_query = new WP_Query(array(
    'post_type' => 'coupon',
    'posts_per_page' => 6,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'coupon_display_top',
            'value' => '1',
            'compare' => '='
        )
    )
));

if (!$coupon_query->have_posts())
    return;
?>

<!-- OUR COUPON START -->
<div class="section-full p-t80 p-b80 coupon-premium-section">
    <div class="container container-wide">

        <!-- TITLE START-->
        <div class="center wt-small-separator-outer section-head">
            <div class="wt-small-separator">
                <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt=""></div>
                <div class="title-label"><?php esc_html_e('Special Offers', 'saloni'); ?></div>
                <div class="sep-leaf-right"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
            </div>
            <h2 class="premium-title" data-title="<?php esc_attr_e('Coupon', 'saloni'); ?>">
                <?php esc_html_e('Campaign & Coupon', 'saloni'); ?>
            </h2>
        </div>
        <!-- TITLE END-->

        <div class="section-content">
            <div class="row d-flex justify-content-center">
                <?php while ($coupon_query->have_posts()):
                    $coupon_query->the_post();
                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $coupon_title = get_the_title();
                    $coupon_price = get_field('coupon_price');
                    $coupon_description = get_field('coupon_description');
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 m-b40">
                        <div class="coupon-premium-card">
                            <div class="card-inner">
                                <div class="card-media">
                                    <?php if ($img_url): ?>
                                        <img src="<?php echo esc_url($img_url); ?>"
                                            alt="<?php echo esc_attr($coupon_title); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo $theme_uri; ?>/images/gallery/default.jpg" alt="">
                                    <?php endif; ?>

                                    <div class="card-overlay"></div>

                                    <?php if (function_exists('saloni_should_show_new_tag') && saloni_should_show_new_tag(get_the_ID())): ?>
                                        <span class="premium-new-tag">New Arrival</span>
                                    <?php endif; ?>

                                    <?php if ($coupon_price): ?>
                                        <div class="price-badge">
                                            <span class="price-val"><?php echo esc_html($coupon_price); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="card-info">
                                    <h3 class="card-title"><?php echo esc_html($coupon_title); ?></h3>
                                    <?php if ($coupon_description): ?>
                                        <div class="card-desc">
                                            <p><?php echo nl2br(esc_html($coupon_description)); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-footer">
                                        <span class="footer-line"></span>
                                        <span class="footer-dot"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>

            <div class="text-center p-t20">
                <a href="<?php echo esc_url(home_url('/coupons/')); ?>" class="premium-more-btn">
                    <span><?php esc_html_e('View All Coupons', 'saloni'); ?></span>
                    <i class="fa fa-chevron-right"></i>
                </a>
            </div>
        </div>

    </div>
</div>

<style>
    /* Premium Coupon Section Root */
    .coupon-premium-section {
        background-color: #fcfafc;
        position: relative;
        overflow: hidden;
    }

    .coupon-premium-section::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -5%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(84, 31, 92, 0.03) 0%, rgba(255, 255, 255, 0) 70%);
        z-index: 0;
    }

    .container-wide {
        max-width: 1430px;
        position: relative;
        z-index: 1;
    }

    /* Section Header Enhancement */
    .premium-title {
        font-family: 'Yeseva One', cursive;
        color: #541f5c;
        font-size: 42px;
        margin-top: 10px;
    }

    .title-label {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #888;
        font-size: 13px;
    }

    /* Coupon Card Design */
    .coupon-premium-card {
        height: 100%;
        perspective: 1000px;
    }

    .card-inner {
        background: #fff;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(84, 31, 92, 0.05);
        transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid rgba(84, 31, 92, 0.05);
    }

    .coupon-premium-card:hover .card-inner {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(84, 31, 92, 0.12);
    }

    /* Media Area */
    .card-media {
        position: relative;
        overflow: hidden;
        height: 260px;
    }

    .card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .coupon-premium-card:hover .card-media img {
        transform: scale(1.1);
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(84, 31, 92, 0) 0%, rgba(84, 31, 92, 0.2) 100%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .coupon-premium-card:hover .card-overlay {
        opacity: 1;
    }

    /* New Tag */
    .premium-new-tag {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #d4af37 0%, #f9e29c 50%, #d4af37 100%);
        color: #fff;
        padding: 6px 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        z-index: 2;
        letter-spacing: 1px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    /* Price Badge */
    .price-badge {
        position: absolute;
        bottom: -15px;
        right: 25px;
        background: #541f5c;
        color: #fff;
        padding: 12px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(84, 31, 92, 0.2);
        z-index: 3;
        transition: all 0.3s ease;
    }

    .coupon-premium-card:hover .price-badge {
        background: #111;
        transform: scale(1.05);
    }

    .price-val {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: -0.5px;
    }

    /* Info Area */
    .card-info {
        padding: 40px 30px 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-family: 'Yeseva One', cursive;
        font-size: 22px;
        color: #111;
        margin-bottom: 15px;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .coupon-premium-card:hover .card-title {
        color: #541f5c;
    }

    .card-desc {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #666;
        line-height: 1.8;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    .card-footer {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: auto;
    }

    .footer-line {
        height: 2px;
        background: rgba(84, 31, 92, 0.1);
        flex-grow: 1;
        border-radius: 2px;
    }

    .footer-dot {
        width: 8px;
        height: 8px;
        background: #541f5c;
        border-radius: 50%;
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }

    .coupon-premium-card:hover .footer-dot {
        opacity: 1;
        box-shadow: 0 0 10px rgba(84, 31, 92, 0.5);
    }

    /* More Button */
    .premium-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 45px;
        background: transparent;
        border: 2px solid #541f5c;
        color: #541f5c;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 15px;
        border-radius: 50px;
        transition: all 0.4s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .premium-more-btn i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }

    .premium-more-btn:hover {
        color: #fff;
        background: #541f5c;
    }

    .premium-more-btn:hover i {
        transform: translateX(5px);
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .card-media {
            height: 220px;
        }

        .card-title {
            font-size: 20px;
        }

        .premium-title {
            font-size: 34px;
        }
    }

    @media (max-width: 767px) {
        .card-info {
            padding: 35px 25px 25px;
        }

        .premium-title {
            font-size: 28px;
        }

        .price-badge {
            padding: 10px 20px;
            right: 20px;
        }

        .price-val {
            font-size: 16px;
        }
    }
</style>
<!-- OUR COUPON SECTION END -->