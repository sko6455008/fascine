<?php
/**
 * Template Name: Gallery Page
 * Description: Template for the Gallery page with masonry grid
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();

// 現在のページ番号を取得
$current_page = get_query_var('paged') ? get_query_var('paged') : 1;

// メインカテゴリーとサブカテゴリーを取得
$main_category = get_query_var('gallery_main_category');
$sub_category = get_query_var('gallery_sub_category');

// 1ページあたりの表示数
$posts_per_page = 2;

// ギャラリー投稿を取得
$gallery_query = saloni_get_gallery_page_posts($main_category, $sub_category, $posts_per_page, $current_page);

// 総ページ数を計算
$total_posts = $gallery_query->found_posts;
$total_pages = ceil($total_posts / $posts_per_page);

// カテゴリー名を動的に取得
$main_category_name = saloni_get_main_category_name($main_category);
$sub_category_name = saloni_get_sub_category_name($main_category, $sub_category);
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/9.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary"><?php echo esc_html($main_category_name); ?></h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><?php echo esc_html($main_category_name); ?></li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- GALLERY SECTION START -->
<div class="section-full p-t50 p-b50 bg-orange-light">
    <div class="container">
        <?php 
        $sub_categories = saloni_get_course_choices($main_category);
        if (!empty($sub_categories)) : 
            $get_subcat_url = function($slug) use ($main_category) {
                switch ($main_category) {
                    case 'guest':
                        return home_url('/gallery_guest_nail/' . $slug . '/');
                    case 'arts-parts':
                        return home_url('/gallery_arts_parts/' . $slug . '/');
                    case 'hand':
                    case 'foot':
                    default:
                        return home_url('/gallery_' . $main_category . '_design/' . $slug . '/');
                }
            };
            
            // 全てのサブカテゴリーを表示
        ?>
        <div class="filter-wrap work-grid p-b30 text-center">
            <ul class="gallery-nav-filter link-style">
                <?php foreach ($sub_categories as $slug => $name): 
                    $is_active = ($sub_category === $slug);
                    $subcat_url = $get_subcat_url($slug);
                ?>
                <li<?php echo $is_active ? ' class="active"' : ''; ?>>
                    <a href="<?php echo esc_url($subcat_url); ?>">
                        <?php echo esc_html($name); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- GALLERY CONTENT START -->
        <div class="masonry-wrap mfp-gallery row clearfix">
            <?php if ($gallery_query->have_posts()) : ?>
                <?php while ($gallery_query->have_posts()) : $gallery_query->the_post(); 
                    $gallery_title = get_the_title();
                    $gallery_description = get_field('gallery_description');
                    $gallery_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    
                    if (!$gallery_img) {
                        $gallery_img = $theme_uri . '/images/gallery/default.jpg';
                    }
                ?>
                <div class="masonry-item col-lg-4 col-md-6 col-sm-6 m-b30">
                    <div class="project-img-effect-1">
                        <img src="<?php echo esc_url($gallery_img); ?>" alt="<?php echo esc_attr($gallery_title); ?>">
                        <div class="wt-info">
                            <h3 class="wt-tilte m-b10 m-t0"><?php echo esc_html($gallery_title); ?></h3>
                            <?php if ($gallery_description) : ?>
                                <p class="title-style-2"><?php echo esc_html($gallery_description); ?></p>
                            <?php endif; ?>
                        </div>
                        <i></i>
                        <a href="<?php echo esc_url($gallery_img); ?>" class="mfp-link"></a>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="col-12">
                    <div class="text-center">
                        <p>現在、このカテゴリーにギャラリーアイテムはありません。</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- GALLERY CONTENT END -->

        <!-- PAGINATION START -->
        <?php if ($total_pages > 1) : 
            // カテゴリーに応じたベースURLを生成
            if ($main_category === 'guest') {
                $base_url = home_url("gallery_guest_nail/{$sub_category}/page/%#%/");
            } elseif ($main_category === 'arts-parts') {
                $base_url = home_url("gallery_arts_parts/{$sub_category}/page/%#%/");
            } else {
                $base_url = home_url("gallery_{$main_category}_design/{$sub_category}/page/%#%/");
            }

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
            <ul class="pagination gallery-pagination">
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
<!-- GALLERY SECTION END -->

<style>
.gallery-nav-filter {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px 30px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
    max-width: 900px;
}
.gallery-nav-filter li {
    margin: 0;
}
.gallery-nav-filter li a {
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #333;
    padding: 5px 10px;
}
.gallery-nav-filter li a:hover,
.gallery-nav-filter li.active a {
    color: #541f5c;
}

@media (max-width: 767px) {
    .gallery-nav-filter {
        gap: 10px 20px;
    }
}

/* ページネーション */
.gallery-pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.gallery-pagination .page-item {
    display: inline-block;
}
.gallery-pagination .page-link {
    display: block;
    padding: 10px 16px;
    color: #541f5c;
    background-color: #fff;
    border: 1px solid #ddd;
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 4px;
}
.gallery-pagination .page-link:hover {
    background-color: #541f5c;
    color: #fff;
    border-color: #541f5c;
}
.gallery-pagination .page-item.active .page-link,
.gallery-pagination .page-link.current {
    background-color: #541f5c;
    color: #fff;
    border-color: #541f5c;
}
</style>

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>