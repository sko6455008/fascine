<?php
/**
 * The template for displaying all single posts
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper" style="background-image:url(<?php echo $theme_uri; ?>/images/banner/9.jpg);">
    <div class="overlay-main bg-black opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer text-center">
                <div class="banner-title-name">
                    <h2 class="wt-title">
                        <?php the_title(); ?>
                    </h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php esc_html_e('Home', 'saloni'); ?>
                        </a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                            <?php esc_html_e('Blog', 'saloni'); ?>
                        </a></li>
                    <li>
                        <?php the_title(); ?>
                    </li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- BLOG SINGLE POST -->
<div class="section-full p-t80 p-b50 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 blog-content">
                <?php while (have_posts()):
                    the_post(); ?>
                    <div class="blog-post blog-lg date-style-2">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="wt-post-media wt-img-effect">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="wt-post-info bg-white p-t30">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>
                                            <?php echo get_the_date('Y-m-d'); ?>
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
                                <h2 class="post-title">
                                    <?php the_title(); ?>
                                </h2>
                            </div>
                            <div class="wt-post-text">
                                <?php the_content(); ?>
                            </div>

                            <?php
                            // Post tags
                            $tags = get_the_tags();
                            if ($tags):
                                ?>
                                <div class="wt-post-tags m-t30">
                                    <strong>
                                        <?php esc_html_e('Tags:', 'saloni'); ?>
                                    </strong>
                                    <?php foreach ($tags as $tag): ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge badge-secondary">
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Post Navigation -->
                            <div class="post-navigation m-t30 m-b30">
                                <div class="row">
                                    <div class="col-6">
                                        <?php
                                        $prev_post = get_previous_post();
                                        if ($prev_post):
                                            ?>
                                            <a href="<?php echo get_permalink($prev_post); ?>"
                                                class="site-button site-btn-effect">
                                                <i class="fa fa-angle-left"></i>
                                                <?php esc_html_e('Previous', 'saloni'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6 text-right">
                                        <?php
                                        $next_post = get_next_post();
                                        if ($next_post):
                                            ?>
                                            <a href="<?php echo get_permalink($next_post); ?>"
                                                class="site-button site-btn-effect">
                                                <?php esc_html_e('Next', 'saloni'); ?> <i class="fa fa-angle-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="col-lg-4 col-md-12 sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<!-- BLOG SINGLE POST END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>

<style>
.blog-content{
    padding: 0 30px;
}
.sidebar {
    background-color: #feede7;
    padding: 15px;
    height: 100%;
}
.wt-post-text {
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
}
</style>