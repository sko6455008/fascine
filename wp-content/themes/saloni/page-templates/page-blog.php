<?php
/**
 * Template Name: Blog Page
 * Description: Template for the Blog page
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- INNER PAGE BANNER -->
<div class="wt-bnr-inr overlay-wraper bg-center"
    style="background-image:url(<?php echo $theme_uri; ?>/images/banner/9.jpg);">
    <div class="overlay-main site-bg-secondry opacity-07"></div>
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
<div class="section-full p-t80 p-b50 bg-white blog-post-outer-3">
    <div class="container">

        <!-- BLOG SECTION START -->
        <div class="section-content">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block one-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum1.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>20 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">How to keep your makeup in place all day</a></h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block two-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum2.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>25 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">Everything's Coming Up Rose Gold</a></h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block three-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum3.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>31 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">How to return your hair to normal after the Winter</a>
                                </h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block one-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum4.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>20 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">How to keep your makeup in place all day</a></h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block two-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum5.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>25 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">Everything's Coming Up Rose Gold</a></h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block three-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum6.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>31 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">How to return your hair to normal after the Winter</a>
                                </h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block one-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum7.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>20 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">How to keep your makeup in place all day</a></h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block two-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum8.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>25 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">Everything's Coming Up Rose Gold</a></h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!--Block three-->
                    <div class="blog-post date-style-2">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="<?php echo esc_url(home_url('/blog/')); ?>"><img
                                    src="<?php echo $theme_uri; ?>/images/blog/default/thum9.jpg" alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-a20 p-b0 text-center">
                            <div class="wt-post-meta">
                                <ul>
                                    <li class="post-date"><span>31 Jan 2025</span></li>
                                    <li class="post-user"><a href="<?php echo esc_url(home_url('/blog/')); ?>">By <span
                                                class="site-text-primary">Sophia Varner</span></a></li>
                                    <li class="post-comment"><a
                                            href="<?php echo esc_url(home_url('/blog/')); ?>">Comment <span
                                                class="site-text-primary">24</span></a></li>
                                </ul>
                            </div>
                            <div class="wt-post-title">
                                <h3 class="post-title"><a href="<?php echo esc_url(home_url('/blog/')); ?>"
                                        class="site-text-primary">How to return your hair to normal after the Winter</a>
                                </h3>
                            </div>
                            <div class="wt-post-readmore">
                                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="site-button-link black">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <ul class="pagination m-b0 p-b0">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>

        </div>

    </div>

</div>
<!-- OUR BLOG END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>