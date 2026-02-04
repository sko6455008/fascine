<?php
/**
 * Footer template
 *
 * @package Saloni
 */
?>
    </div>
    <!-- CONTENT END -->

    <!-- FOOTER START -->
    <footer class="site-footer footer-large footer-dark text-white">
        
        <!-- FOOTER BLOCKS START -->  
        <div class="footer-top dot2-left-top-img">
            <div class="container">
                <div class="row">
                
                    <div class="col-lg-6 col-md-12 col-sm-12">  
                        <div class="widget widget_about">
                            <div class="logo-footer clearfix p-b15">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-light.png" alt="<?php bloginfo('name'); ?>">
                                </a>
                            </div>
                            <p><?php echo esc_html(saloni_get_option('saloni_footer_description', '池袋駅徒歩3分の技術×トレンドを兼ね備えた人気店。丁寧なフィルインとケアにより驚きのモチを実現。韓国ネイルやワンホン、ニュアンスなど旬のデザインやパーツも豊富です。持ち込み大歓迎＆10日間保証付。')); ?></p>            
                        </div>
                        
                    </div> 

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="widget widget_services">
                            <h4 class="widget-title"><?php esc_html_e('Useful links', 'saloni'); ?></h4>
                            <?php
                            if (has_nav_menu('footer')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'footer',
                                    'container'      => false,
                                    'menu_class'     => '',
                                    'fallback_cb'    => false,
                                ));
                            } else {
                            ?>
                            <ul>
                                <li><a href="<?php echo esc_url(home_url('/concept/')); ?>"><?php esc_html_e('Concept', 'saloni'); ?></a><a href="<?php echo esc_url(home_url('/gallery/')); ?>"><?php esc_html_e('Gallery', 'saloni'); ?></a></li>
                                <li><a href="<?php echo esc_url(home_url('/menu/')); ?>"><?php esc_html_e('Menu', 'saloni'); ?></a><a href="<?php echo esc_url(home_url('/access/')); ?>"><?php esc_html_e('Access', 'saloni'); ?></a></li>
                                <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php esc_html_e('Blog', 'saloni'); ?></a><a href="<?php echo esc_url(home_url('/qa/')); ?>"><?php esc_html_e("Q&A's", 'saloni'); ?></a></li>
                            </ul>
                            <?php } ?>
                        </div>
                                            
                    </div> 

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="widget recent-posts-entry">
                            <h4 class="widget-title"><?php esc_html_e('Access', 'saloni'); ?></h4>
                            <ul class="widget_address"> 
                                <li><i class="fa-solid fa-location-dot"></i><?php echo esc_html(saloni_get_option('saloni_address', '東京都豊島区池袋2-40-13VORT池袋ビル3F')); ?></li>
                                <li><i class="fa fa-phone"></i><?php echo esc_html(saloni_get_option('saloni_phone', '050-5305-3298')); ?></li>
                            </ul>  
                        </div>           
                    </div>
                                              
                </div>
            </div>
        </div>
        <!-- FOOTER COPYRIGHT -->
        
        <div class="footer-bottom">
            <div class="container">
                <div class="wt-footer-bot-left d-flex justify-content-center">
                    <span class="copyrights-text"><?php echo esc_html(saloni_get_option('saloni_copyright', 'Copyright © ' . date('Y') . ' Thewebmax')); ?></span>   
                </div>
            </div>   
        </div>   

    </footer>
    <!-- FOOTER END -->

</div>
<!-- page-wraper END -->

<!-- LOADING AREA  START ===== -->
<div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="cssload-loader">
            <div class="cssload-dots">
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
                <div class="cssload-dot"></div>
            </div>
        </div>  
    </div>
</div>
<!-- LOADING AREA  END ====== -->

<?php wp_footer(); ?>

</body>

</html>
