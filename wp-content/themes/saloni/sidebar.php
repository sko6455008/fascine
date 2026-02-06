<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();
?>

<aside class="side-bar">
    <?php if (is_active_sidebar('sidebar-1')): ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else: ?>
        <!-- Default sidebar content if no widgets -->
        <div class="widget recent-posts-entry">
            <h4 class="widget-title">
                <?php esc_html_e('最新記事', 'saloni'); ?>
            </h4>
            <div class="widget-post-bx">
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 3,
                    'post_status' => 'publish',
                ));
                foreach ($recent_posts as $post):
                    ?>
                    <div class="widget-post clearfix">
                        <?php if (has_post_thumbnail($post['ID'])): ?>
                            <div class="wt-post-media">
                                <img src="<?php echo get_the_post_thumbnail_url($post['ID'], 'thumbnail'); ?>"
                                    alt="<?php echo esc_attr($post['post_title']); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="wt-post-info">
                            <div class="wt-post-header">
                                <h6 class="post-title"><a href="<?php echo get_permalink($post['ID']); ?>">
                                        <?php echo esc_html($post['post_title']); ?>
                                    </a></h6>
                            </div>
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date">
                                        <?php echo get_the_date('Y-m-d', $post['ID']); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                wp_reset_query(); ?>
            </div>
        </div>

        <div class="widget widget_categories">
            <h4 class="widget-title">
                <?php esc_html_e('カテゴリー', 'saloni'); ?>
            </h4>
            <ul>
                <?php
                wp_list_categories(array(
                    'orderby' => 'name',
                    'show_count' => true,
                    'title_li' => '',
                ));
                ?>
            </ul>
        </div>

    <?php endif; ?>
</aside>

<style>
.widget_categories ul {
    list-style: none;
}
.recent-posts-entry{
    margin-bottom: 40px !important;
}
</style>
