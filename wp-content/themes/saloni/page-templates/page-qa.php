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
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/qa.webp);">
    <div class="overlay-main site-bg-secondary opacity-07"></div>
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

                    <?php if ($qa_query->have_posts()) : 
                        $qa_groups = array(
                            'service' => array(),
                            'reservation' => array(),
                            'other' => array(),
                        );
                        
                        $qa_labels = array(
                            'service' => '施術について',
                            'reservation' => '予約について',
                            'other' => 'その他',
                        );

                        while ($qa_query->have_posts()) {
                            $qa_query->the_post();
                            $type = get_field('qa_type');
                            if (array_key_exists($type, $qa_groups)) {
                                $qa_groups[$type][] = get_post();
                            } else {
                                $qa_groups['other'][] = get_post();
                            }
                        }
                        wp_reset_postdata();
                        
                        $global_index = 0;
                        foreach ($qa_groups as $type => $posts) :
                            if (empty($posts)) continue;
                            ?>
                            
                            <div class="qa-section-header p-a15 m-b20 bg-gray-light">
                                <h4 class="m-b0 font-weight-600"><?php echo esc_html($qa_labels[$type]); ?></h4>
                            </div>

                            <div class="wt-accordion acc-bg-white m-b40" id="accordion-<?php echo esc_attr($type); ?>">
                                <?php 
                                foreach ($posts as $post) : 
                                    setup_postdata($post);
                                    $question = get_field('qa_question');
                                    $answer = get_field('qa_answer');
                                    $global_index++;
                                    $collapse_id = 'collapse-' . $global_index;
                                    $heading_id = 'heading-' . $global_index;
                                ?>
                                    <div class="panel wt-panel">
                                        <div class="acod-head" id="<?php echo esc_attr($heading_id); ?>">
                                            <h4 class="acod-title">
                                                <a data-toggle="collapse" href="#<?php echo esc_attr($collapse_id); ?>" class="collapsed" data-parent="#accordion-<?php echo esc_attr($type); ?>">
                                                    <?php echo esc_html($question); ?>
                                                    <span class="indicator"><i class="fa fa-plus"></i></span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="<?php echo esc_attr($collapse_id); ?>" class="acod-body collapse" aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-parent="#accordion-<?php echo esc_attr($type); ?>">
                                            <div class="acod-content p-a20 bg-white">
                                                <?php echo wp_kses_post($answer); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                endforeach; 
                                wp_reset_postdata();
                                ?>
                            </div>
                        <?php endforeach; ?>

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