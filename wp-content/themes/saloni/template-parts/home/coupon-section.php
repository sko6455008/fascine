<?php
/**
 * Coupon Section Template Part
 * 
 * Redesigned to match a premium luxury card aesthetic.
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
            <div class="row luxury-coupon-row">
                <?php while ($coupon_query->have_posts()):
                    $coupon_query->the_post();
                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $coupon_title = get_the_title();
                    $coupon_price_raw = get_field('coupon_price');
                    $coupon_description = get_field('coupon_description');
                    
                    // 価格のパース (例: "7,980/8,980" または "7,980")
                    $prices = explode('/', $coupon_price_raw);
                    $new_price = trim($prices[0]);
                    $repeat_price = isset($prices[1]) ? trim($prices[1]) : '';
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 m-b40">
                        <div class="luxury-coupon-card">
                            <div class="card-inner-dotted">
                                
                                <div class="card-header-brand">
                                    <div class="brand-id"> <?php echo esc_html($coupon_title); ?></div>
                                    <div class="brand-tagline"><?php echo esc_html($coupon_description); ?></div>
                                </div>

                                <div class="card-media">
                                    <?php if ($img_url): ?>
                                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($coupon_title); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo $theme_uri; ?>/images/gallery/default.jpg" alt="">
                                    <?php endif; ?>
                                </div>

                                <div class="card-price-container">
                                    <div class="price-col new-customer">
                                        <div class="price-label">新規</div>
                                        <div class="price-amount"><?php echo esc_html($new_price); ?></div>
                                    </div>
                                    
                                    <?php if ($repeat_price): ?>
                                    <div class="price-divider"></div>
                                    <div class="price-col repeat-customer">
                                        <div class="price-label">再来</div>
                                        <div class="price-amount"><?php echo esc_html($repeat_price); ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($coupon_description): ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>

            <div class="text-center p-t40">
                <a href="<?php echo esc_url(home_url('/coupons/')); ?>" class="luxury-all-btn">
                    VIEW ALL COUPONS
                </a>
            </div>
        </div>

    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Cormorant+Garamond:wght@400;600;700&display=swap');

    .luxury-coupon-card {
        padding: 5px;
        height: 100%;
    }

    .card-inner-dotted {
        border: 1px dashed #ccc;
        background: #fff;
        padding: 40px 30px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .luxury-coupon-card:hover .card-inner-dotted {
        border-color: #111;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    }

    .card-header-brand {
        margin-bottom: 30px;
    }

    .brand-id {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.1;
        color: #111;
        letter-spacing: -1px;
    }

    .brand-tagline {
        font-family: 'Poppins', sans-serif;
        font-size: 10px;
        letter-spacing: 5px;
        color: #999;
        margin-top: 5px;
        text-transform: uppercase;
    }

    .card-media {
        width: 100%;
        overflow: hidden;
    }

    .card-media img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s ease;
    }

    .luxury-coupon-card:hover .card-media img {
        transform: scale(1.05);
    }

    .card-price-container {
        display: flex;
        justify-content: center;
        align-items: center;
        border-top: 1px solid #f5f5f5;
        padding-top: 30px;
    }

    .price-col {
        flex: 1;
    }

    .price-label {
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .new-customer .price-label {
        color: #c4a066;
    }

    .repeat-customer .price-label {
        color: #999;
    }

    .price-amount {
        font-family: 'Playfair Display', serif;
        font-size: 35px;
        font-weight: 700;
        color: #111;
        line-height: 1;
    }

    .price-divider {
        width: 1px;
        height: 80px;
        background: #eee;
        margin: 0 10px;
    }

    .luxury-all-btn {
        display: inline-block;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 3px;
        color: #111;
        text-decoration: none;
        border: 2px solid #111;
        padding: 15px 40px;
        transition: all 0.3s ease;
    }

    .luxury-all-btn:hover {
        background: #111;
        color: #fff;
    }

    @media (max-width: 767px) {
        .brand-id {
            font-size: 36px;
        }

        .price-amount {
            font-size: 32px;
        }
    }
</style>
<!-- OUR COUPON SECTION END -->