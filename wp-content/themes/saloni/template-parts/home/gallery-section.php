<?php
/**
 * Gallery Section Template Part
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();

// HANDデザインのギャラリーを取得（9件）
$hand_gallery = new WP_Query(array(
    'post_type' => 'gallery',
    'posts_per_page' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'gallery_main_category',
            'value' => 'hand',
            'compare' => '='
        )
    )
));



// GUESTギャラリーを取得（9件）
$guest_gallery = new WP_Query(array(
    'post_type' => 'gallery',
    'posts_per_page' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'gallery_main_category',
            'value' => 'guest',
            'compare' => '='
        )
    )
));

// ギャラリーセクションを出力する関数
function fascina_render_gallery_section($query, $title, $subtitle, $link_url, $theme_uri)
{
    if (!$query->have_posts())
        return;
    ?>
    <div class="gallery-category-section">
        <div class="gallery-category-header">
            <h3 class="gallery-category-title"><?php echo esc_html($title); ?></h3>
            <p class="gallery-category-subtitle"><?php echo esc_html($subtitle); ?></p>
        </div>
        <div class="row justify-content-center">
            <?php while ($query->have_posts()):
                $query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $gallery_title = get_the_title();
                $sub_category = get_field('gallery_sub_category');
                $sub_category_name = '';
                if ($sub_category && function_exists('fascina_get_sub_category_name')) {
                    $main_cat = get_field('gallery_main_category');
                    $sub_category_name = fascina_get_sub_category_name($main_cat, $sub_category);
                }
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                    <div class="wt-gallery-1">
                        <div class="wt-media">
                            <?php if ($img_url): ?>
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($gallery_title); ?>">
                            <?php else: ?>
                                <img src="<?php echo $theme_uri; ?>/images/gallery/default.jpg" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="wt-info bg-white p-a30 shadow-lg">
                            <div class="gallery-detail text-center">
                                <h3 class="m-t0"><?php echo esc_html($gallery_title); ?></h3>
                                <?php if ($sub_category_name): ?>
                                    <span class="title-style-2 gallery-position">
                                        <?php echo esc_html($sub_category_name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
        <div class="wt-post-readmore">
            <a href="#" class="site-button-link black">
                <?php esc_html_e('Read More', 'saloni'); ?>
            </a>
        </div>
    </div>
    <?php
}
?>

<!-- OUR GALLERY START -->
<div class="section-full p-t80 p-b40 bg-white gallery-post-outer">
    <div class="container">

        <!-- TITLE START-->
        <div class="center wt-small-separator-outer section-head">
            <div class="wt-small-separator">
                <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt="">
                </div>
                <div>
                    <?php esc_html_e('Nail Design', 'saloni'); ?>
                </div>
                <div class="sep-leaf-right"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt="">
                </div>
            </div>
            <h2 data-title="<?php esc_attr_e('Gallery', 'saloni'); ?>">
                <?php esc_html_e('Gallery', 'saloni'); ?>
            </h2>
        </div>
        <!-- TITLE END-->

        <div class="section-content">
            <!-- HANDデザイン -->
            <?php fascina_render_gallery_section($hand_gallery, 'HAND Design', 'ハンドデザイン', home_url('/gallery_hand_design/'), $theme_uri); ?>

            <!-- GUESTギャラリー -->
            <?php fascina_render_gallery_section($guest_gallery, 'GUEST Gallery', 'ゲストギャラリー', home_url('/gallery_guest_nail/'), $theme_uri); ?>
        </div>

    </div>
</div>

<style>
    /* ギャラリーカテゴリセクション */
    .gallery-post-outer .container {
        max-width: 1430px;
    }

    .gallery-category-section {
        margin-bottom: 60px;
    }

    .gallery-category-section:last-child {
        margin-bottom: 0;
    }

    .gallery-category-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .gallery-category-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .gallery-category-subtitle {
        font-size: 14px;
        color: #888;
        margin: 0;
    }

    /* ギャラリーアイテム */
    .wt-gallery-1 {
        transition: transform 0.3s ease;
    }

    .wt-gallery-1:hover {
        transform: translateY(-5px);
    }

    .wt-gallery-1 .wt-media {
        position: relative;
        overflow: hidden;
    }

    .wt-gallery-1 .wt-media img {
        width: 100%;
        height: auto;
        object-fit: cover;
        aspect-ratio: 4 / 3;
        background-color: #f8f8f8;
        transition: transform 0.3s ease;
    }

    .wt-gallery-1:hover .wt-media img {
        transform: scale(1.02);
    }

    .wt-gallery-1 .wt-info {
        padding: 20px !important;
    }

    .wt-gallery-1 .gallery-detail h3 {
        font-size: 16px;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .wt-gallery-1 .gallery-position {
        font-size: 12px;
        color: #888;
    }

    .gallery-category-section .wt-post-readmore {
        text-align: center;
        margin-top: 20px;
    }

    .gallery-more-link {
        text-align: center;
        margin-top: 20px;
    }

    /* レスポンシブ */
    @media (max-width: 991px) {
        .gallery-category-title {
            font-size: 24px;
        }
    }

    @media (max-width: 767px) {
        .gallery-category-section {
            margin-bottom: 40px;
        }

        .gallery-category-title {
            font-size: 20px;
        }

        .wt-gallery-1 .gallery-detail h3 {
            font-size: 14px;
        }
    }
</style>
<!-- OUR GALLERY SECTION END -->