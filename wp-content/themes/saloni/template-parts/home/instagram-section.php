<?php
/**
 * Instagram Section Template Part
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();
$instagram_url = saloni_get_option('saloni_instagram', 'https://www.instagram.com/');
?>

<!-- INSTAGRAM FOLLOW START -->
<div class="section-full p-t80 p-b50 bg-orange-light">
    <div class="container-fluid">
        <div class="section-content">
               
            <div class="section-content">
                <div class="row">
                
                    <div class="col-xl-4 col-lg-5 col-md-12 instagram-follows-section bg-white">
                        <div class="p-a30">
                            <!-- TITLE START-->
                            <div class="left wt-small-separator-outer">
                                <div class="wt-small-separator">
                                    <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt=""></div>
                                    <div><?php esc_html_e('Follow Us', 'saloni'); ?></div>
                                    <div class="sep-leaf-right"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt=""></div>
                                </div>
                            </div>
                            <h2><?php esc_html_e('Instagram', 'saloni'); ?></h2>
                            <!-- TITLE END-->
                        </div>
                    </div>
                    
                    <div class="col-xl-8 col-lg-7 col-md-12 instagram-pics-slide-outer">
                        <div class="instagram-pics-slide">
                            <div class="owl-carousel instagram-slider owl-btn-bottom-left light-next-prev">
                            
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/1.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>
                                                <span class="title-style-2"><?php esc_html_e('Haircut', 'saloni'); ?></span>
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/2.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/3.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/4.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a> 
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/5.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/6.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/7.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="item">
                                    <div class="wt-box instagram-box-1">
                                        <div class="instagram-box-media"><img src="<?php echo $theme_uri; ?>/images/instagram/8.jpg" alt=""></div>
                                        <div class="instagram-box-info text-center">
                                            <a href="<?php echo esc_url($instagram_url); ?>" class="text-white">
                                                <i class="fa-brands fa-instagram"></i>      
                                                <span class="title-style-2"><?php esc_html_e('Gallery', 'saloni'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>                                                     
                                
                            </div>                                        	
                        </div>
                    </div>
                    
                </div>
            </div>      
        
        </div>
    </div>
</div>   
<!-- INSTAGRAM FOLLOW SECTION END -->
