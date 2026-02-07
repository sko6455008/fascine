<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper" style="background-image:url(<?php echo $theme_uri; ?>/images/banner/blog.webp);">
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer text-center">
                <div class="banner-title-name">
                    <h2 class="wt-title">
                        <?php esc_html_e('Blog', 'saloni'); ?>
                    </h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php esc_html_e('Home', 'saloni'); ?>
                        </a></li>
                    <li>
                        <?php esc_html_e('Blog', 'saloni'); ?>
                    </li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- BLOG CONTENT -->
<div class="section-full p-t80 p-b50 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()):
                        the_post(); ?>
                        <div class="blog-post date-style-2 m-b30">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="wt-post-media wt-img-effect zoom-slow">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="wt-post-info bg-white p-a30">
                                <div class="wt-post-meta">
                                    <ul>
                                        <li class="post-date"><span>
                                                <?php echo get_the_date('d M Y'); ?>
                                            </span></li>
                                        <li class="post-user"><a
                                                href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php esc_html_e('By', 'saloni'); ?> <span class="site-text-primary">
                                                    <?php the_author(); ?>
                                                </span>
                                            </a></li>
                                        <li class="post-comment"><a href="<?php comments_link(); ?>">
                                                <?php esc_html_e('Comments', 'saloni'); ?> <span class="site-text-primary">
                                                    <?php echo get_comments_number(); ?>
                                                </span>
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="wt-post-title">
                                    <h3 class="post-title"><a href="<?php the_permalink(); ?>" class="site-text-primary">
                                            <?php the_title(); ?>
                                        </a></h3>
                                </div>
                                <div class="wt-post-text">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="wt-post-readmore">
                                    <a href="<?php the_permalink(); ?>" class="site-button site-btn-effect">
                                        <?php esc_html_e('Read More', 'saloni'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <!-- PAGINATION -->
                    <div class="pagination-outer m-b30">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '<i class="fa fa-angle-left"></i>',
                            'next_text' => '<i class="fa fa-angle-right"></i>',
                        ));
                        ?>
                    </div>

                <?php else: ?>
                    <div class="no-posts">
                        <h2>
                            <?php esc_html_e('No posts found', 'saloni'); ?>
                        </h2>
                        <p>
                            <?php esc_html_e('Sorry, but nothing matched your search terms.', 'saloni'); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4 col-md-12">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<!-- BLOG CONTENT END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>