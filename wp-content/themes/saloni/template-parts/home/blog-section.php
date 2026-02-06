<?php
/**
 * Blog Section Template Part
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();

// Get recent blog posts
$recent_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
));
?>

<?php if ($recent_posts->have_posts()): ?>
    <!-- OUR BLOG START -->
    <div class="section-full p-t80 p-b40 bg-white blog-post-outer-3">
        <div class="container">

            <!-- TITLE START-->
            <div class="center wt-small-separator-outer section-head">
                <div class="wt-small-separator">
                    <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt=""></div>
                    <div>
                        <?php esc_html_e('Staff Blog', 'saloni'); ?>
                    </div>
                    <div class="sep-leaf-right"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                </div>
                <h2 data-title="<?php esc_attr_e('Blog', 'saloni'); ?>">
                    <?php esc_html_e('Blog', 'saloni'); ?>
                </h2>
            </div>
            <!-- TITLE END-->

            <!-- BLOG SECTION START -->
            <div class="section-content">
                <div class="row d-flex justify-content-center">
                    <?php
                    while ($recent_posts->have_posts()):
                        $recent_posts->the_post();
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <!--Block-->
                            <div class="blog-post date-style-2">
                                <div class="wt-post-media wt-img-effect zoom-slow">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('medium_large'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo $theme_uri; ?>/images/blog/default/thum1.jpg"
                                                alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                                    <div class="wt-post-meta">
                                        <ul>
                                            <li class="post-date"><span>
                                                    <?php echo get_the_date('Y-m-d'); ?>
                                                </span></li>
                                            <li class="post-user"><a href="#">
                                                    <?php esc_html_e('By', 'saloni'); ?> <span class="site-text-primary">Sophia
                                                        Varner</span>
                                                </a></li>
                                            <li class="post-comment"><a href="#">
                                                    <?php esc_html_e('Comment', 'saloni'); ?> <span
                                                        class="site-text-primary">24</span>
                                                </a></li>
                                        </ul>
                                    </div>
                                    <div class="wt-post-title">
                                        <h3 class="post-title"><a href="<?php the_permalink(); ?>" class="site-text-primary">
                                                <?php the_title(); ?>
                                            </a></h3>
                                    </div>
                                    <div class="wt-post-readmore">
                                        <a href="<?php the_permalink(); ?>" class="site-button-link black">
                                            <?php esc_html_e('Read More', 'saloni'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- OUR BLOG END -->
<?php endif; ?>