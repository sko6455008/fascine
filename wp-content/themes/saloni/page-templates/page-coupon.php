<?php
/**
 * Template Name: Coupon Page
 * Description: Template for the Coupon page with nailist navigation and pagination
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();

// 現在のページ番号を取得
$current_page = get_query_var('paged') ? get_query_var('paged') : 1;

// 現在のネイリストを取得
$current_nailist = get_query_var('nailist');

// 1ページあたりの表示数
$posts_per_page = 30;

// クーポンを取得するクエリ
$coupon_args = array(
    'post_type' => 'coupon',
    'posts_per_page' => $posts_per_page,
    'paged' => $current_page,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'coupon_display_coupon',
            'value' => '1',
            'compare' => '='
        )
    )
);

// ネイリストでフィルタリング（'list'以外の場合）
if (!empty($current_nailist) && $current_nailist !== 'list') {
    $coupon_args['meta_query']['relation'] = 'AND';
    $coupon_args['meta_query'][] = array(
        'key' => 'coupon_nailist',
        'value' => $current_nailist,
        'compare' => 'LIKE'
    );
}

$coupon_query = new WP_Query($coupon_args);

// 総ページ数を計算
$total_posts = $coupon_query->found_posts;
$total_pages = ceil($total_posts / $posts_per_page);

// ネイリスト名を取得
$nailist_display_name = '';
if (!empty($current_nailist) && $current_nailist !== 'list') {
    $nailist_display_name = saloni_get_nailist_display_name_by_value($current_nailist);
}
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/coupon.webp);">
    <div class="overlay-main site-bg-secondary opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Coupon</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Coupon</li>
                    <?php if ($nailist_display_name) : ?>
                        <li><?php echo esc_html($nailist_display_name); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- COUPON SECTION START -->
<div class="section-full p-t50 p-b50 bg-orange-light coupon-page-section">
    <div class="container">
        <?php 
        // ネイリスト一覧を取得
        $nailists = saloni_get_nailist_choices();
        if (!empty($nailists)) : 
        ?>
        <div class="filter-wrap work-grid p-b30 text-center">
            <ul class="coupon-nav-filter link-style">
                <?php foreach ($nailists as $slug => $name): 
                    $is_active = ($current_nailist === $slug);
                    $nailist_url = home_url('/coupon/' . $slug . '/');
                ?>
                <li<?php echo $is_active ? ' class="active"' : ''; ?>>
                    <a href="<?php echo esc_url($nailist_url); ?>">
                        <?php echo esc_html($name); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- COUPON CONTENT START -->
        <div class="section-content">
            <div class="row luxury-coupon-row">
                <?php if ($coupon_query->have_posts()) : ?>
                    <?php while ($coupon_query->have_posts()) : $coupon_query->the_post();
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
                                    <div class="brand-id"><?php echo esc_html($coupon_title); ?></div>
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
                                        <div class="price-label">初来店</div>
                                        <div class="price-amount"><?php echo esc_html($new_price); ?></div>
                                    </div>
                                    
                                    <?php if ($repeat_price): ?>
                                    <div class="price-divider"></div>
                                    <div class="price-col repeat-customer">
                                        <div class="price-label">2回目以降</div>
                                        <div class="price-amount"><?php echo esc_html($repeat_price); ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="col-12">
                        <div class="text-center">
                            <p>現在、このネイリストのクーポンはありません。</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- COUPON CONTENT END -->

        <!-- PAGINATION START -->
        <?php if ($total_pages > 1) : 
            $base_url = home_url("coupon/{$current_nailist}/page/%#%/");
            
            $pagination_links = paginate_links(array(
                'base' => $base_url,
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => '&laquo; 前へ',
                'next_text' => '次へ &raquo;',
                'type' => 'array',
            ));
        ?>
        <div class="pagination-outer text-center m-t40">
            <?php if ($pagination_links) : ?>
            <ul class="pagination coupon-pagination">
                <?php foreach ($pagination_links as $link) : 
                    $is_current = (strpos($link, 'current') !== false);
                ?>
                <li class="page-item<?php echo $is_current ? ' active' : ''; ?>">
                    <?php echo str_replace('page-numbers', 'page-link', $link); ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <!-- PAGINATION END -->
    </div>
</div>
<!-- COUPON SECTION END -->

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Cormorant+Garamond:wght@400;600;700&display=swap');

/* ナビゲーション */
.coupon-nav-filter {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px 30px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    max-width: 900px;
}
.coupon-nav-filter li {
    margin: 0;
}
.coupon-nav-filter li a {
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #333;
    padding: 5px 10px;
}
.coupon-nav-filter li a:hover,
.coupon-nav-filter li.active a {
    color: #541f5c;
}

/* クーポンカード */
.coupon-page-section .container {
    max-width: 1430px;
}

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

/* ページネーション */
.coupon-pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.coupon-pagination .page-item {
    display: inline-block;
}
.coupon-pagination .page-link {
    display: block;
    padding: 10px 16px;
    color: #541f5c;
    background-color: #fff;
    border: 1px solid #ddd;
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 4px;
}
.coupon-pagination .page-link:hover {
    background-color: #541f5c;
    color: #fff;
    border-color: #541f5c;
}
.coupon-pagination .page-item.active .page-link,
.coupon-pagination .page-link.current {
    background-color: #541f5c;
    color: #fff;
    border-color: #541f5c;
}

@media (max-width: 767px) {
    .coupon-nav-filter {
        gap: 10px 20px;
    }
    .brand-id {
        font-size: 25px;
    }
    .price-amount {
        font-size: 32px;
    }
}
</style>

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>
