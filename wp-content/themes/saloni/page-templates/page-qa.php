<?php
/**
 * Template Name: Q&A Page
 * Description: Template for the Q&A/FAQ page
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();

// Q&Aを取得
$qa_query = new WP_Query(array(
    'post_type' => 'qa',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_status' => 'publish'
));
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/9.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="site-text-primary">Q&A</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Q&A</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- Q&A SECTION START -->
<div class="section-full p-t80 p-b50 bg-orange-light">
    <div class="container">
        <div class="section-content">

            <div class="row d-flex justify-content-center">

                <div class="col-lg-10 col-md-12 col-sm-12">

                    <?php if ($qa_query->have_posts()) : ?>
                        <!-- Accordian -->
                        <div class="wt-accordion acc-bg-white" id="accordion5">

                            <?php 
                            $index = 1;
                            while ($qa_query->have_posts()) : 
                                $qa_query->the_post();
                                $question = get_field('qa_question');
                                $answer = get_field('qa_answer');
                                $collapse_id = 'collapse' . $index;
                                $is_first = ($index === 1);
                            ?>

                                <div class="panel wt-panel">
                                    <div class="acod-head <?php echo $is_first ? 'acc-actives' : ''; ?>">
                                        <h4 class="acod-title">
                                            <a data-toggle="collapse" href="#<?php echo $collapse_id; ?>" 
                                               <?php echo !$is_first ? 'class="collapsed"' : ''; ?>
                                               data-parent="#accordion5">
                                                <?php echo esc_html($question); ?>
                                                <span class="indicator"><i class="fa fa-plus"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $collapse_id; ?>" class="acod-body collapse <?php echo $is_first ? 'show' : ''; ?>">
                                        <div class="acod-content p-a20 bg-white">
                                            <?php echo wp_kses_post($answer); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php 
                                $index++;
                            endwhile; 
                            wp_reset_postdata();
                            ?>

                        </div>
                    <?php else : ?>
                        <div class="alert alert-info">
                            <p>現在、Q&Aは登録されていません。</p>
                            <?php if (current_user_can('edit_posts')) : ?>
                                <p><a href="<?php echo admin_url('post-new.php?post_type=qa'); ?>">Q&Aを追加する</a></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Q&A SECTION END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>