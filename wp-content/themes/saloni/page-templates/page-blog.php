<?php
/**
 * Template Name: Blog Page
 * Description: Template for the Blog page using WordPress standard posts (Blog Grid Style)
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();

// 現在のページ番号を取得
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// 1ページあたりの表示数
$posts_per_page = 30;

// 投稿を取得
$blog_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
));

// 総ページ数
$total_pages = $blog_query->max_num_pages;
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/blog.webp);">
    <div class="overlay-main site-bg-secondary opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Blog</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Blog</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- OUR BLOG START -->
<div class="section-full p-t80 p-b50 bg-white blog-grid-section">
    <div class="container">

        <!-- BLOG SECTION START -->
        <div class="section-content">
            <div class="row d-flex justify-content-center">

                <?php if ($blog_query->have_posts()) : ?>
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 m-b30">
                            <div class="blog-grid-card">
                                <div class="blog-grid-media">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium_large'); ?>
                                        <?php else : ?>
                                            <img src="<?php echo $theme_uri; ?>/images/blog/thum1.jpg" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </a>
                                    <div class="blog-grid-date">
                                        <?php echo get_the_date('Y-m-d'); ?>
                                    </div>
                                </div>
                                <div class="blog-grid-info">
                                    <div class="blog-grid-meta">
                                        <span class="meta-author">By <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span>
                                        <span class="meta-divider">|</span>
                                        <span class="meta-comment"><a href="<?php comments_link(); ?>">Comment <?php echo get_comments_number(); ?></a></span>
                                    </div>
                                    <h3 class="blog-grid-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="blog-grid-readmore">
                                        <a href="<?php the_permalink(); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="col-12 text-center">
                        <p>現在、ブログ記事はありません。</p>
                    </div>
                <?php endif; ?>

            </div>

            <!-- PAGINATION START -->
            <?php if ($total_pages > 1) : 
                $pagination_links = paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%/',
                    'current' => $paged,
                    'total' => $total_pages,
                    'prev_text' => '&laquo; 前へ',
                    'next_text' => '次へ &raquo;',
                    'type' => 'array',
                ));
            ?>
            <div class="pagination-outer text-center m-t40">
                <?php if ($pagination_links) : ?>
                <ul class="pagination blog-pagination">
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

</div>
<!-- OUR BLOG END -->

<style>
/* Blog Grid Styles */
.blog-grid-section {
    background-color: #fff;
}

.blog-grid-card {
    margin-bottom: 30px;
}

.blog-grid-media {
    position: relative;
    overflow: hidden;
}

.blog-grid-media img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.5s ease;
}

.blog-grid-card:hover .blog-grid-media img {
    transform: scale(1.05);
}

.blog-grid-date {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: #000;
    color: #fff;
    padding: 8px 15px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.blog-grid-info {
    padding: 20px 0;
    text-align: center;
}

.blog-grid-meta {
    margin-bottom: 10px;
    font-size: 14px;
    color: #666;
}

.blog-grid-meta a {
    color: #541f5c;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-grid-meta a:hover {
    color: #333;
}

.blog-grid-meta .meta-divider {
    margin: 0 8px;
    color: #999;
}

.blog-grid-meta .meta-comment a {
    color: #666;
}

.blog-grid-meta .meta-comment a span,
.blog-grid-meta .meta-comment span {
    color: #541f5c;
}

.blog-grid-title {
    font-family: 'Yeseva One', serif;
    font-size: 22px;
    font-weight: 400;
    line-height: 1.4;
    margin-bottom: 15px;
}

.blog-grid-title a {
    color: #541f5c;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-grid-title a:hover {
    color: #333;
}

.blog-grid-readmore a {
    color: #333;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    position: relative;
    padding-bottom: 2px;
    transition: color 0.3s ease;
}

.blog-grid-readmore a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #333;
    transition: background-color 0.3s ease;
}

.blog-grid-readmore a:hover {
    color: #541f5c;
}

.blog-grid-readmore a:hover::after {
    background-color: #541f5c;
}

/* ブログページネーション */
.blog-pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.blog-pagination .page-item {
    display: inline-block;
}
.blog-pagination .page-link {
    display: block;
    padding: 10px 16px;
    color: #541f5c;
    background-color: #fff;
    border: 1px solid #ddd;
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 4px;
}
.blog-pagination .page-link:hover {
    background-color: #541f5c;
    color: #fff;
    border-color: #541f5c;
}
.blog-pagination .page-item.active .page-link,
.blog-pagination .page-link.current {
    background-color: #541f5c;
    color: #fff;
    border-color: #541f5c;
}

@media (max-width: 767px) {
    .blog-grid-title {
        font-size: 18px;
    }
}
</style>

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>