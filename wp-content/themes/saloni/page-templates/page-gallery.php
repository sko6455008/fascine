<?php
/**
 * Template Name: Gallery Page
 * Description: Template for the Gallery page with masonry grid
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
                    <h2 class="site-text-primary">Gallery</h2>
                </div>
            </div>
            <!-- BREADCRUMB ROW -->
            <div>
                <ul class="wt-breadcrumb breadcrumb-style-2">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li>Gallery</li>
                </ul>
            </div>
            <!-- BREADCRUMB ROW END -->
        </div>
    </div>
</div>
<!-- INNER PAGE BANNER END -->

<!-- GALLERY SECTION START -->
<div class="section-full p-t80 p-b50 bg-orange-light">
    <div class="container">
        <!-- PAGINATION START -->
        <div class="filter-wrap work-grid p-b30 text-center">
            <ul class="masonry-filter link-style">
                <li class="active"><a data-filter="*" href="#">All</a></li>
                <li><a data-filter=".cat-1" href="#">Hair Product</a></li>
                <li><a data-filter=".cat-2" href="#">Hairstyle</a></li>
                <li><a data-filter=".cat-3" href="#">Makeup</a></li>
                <li><a data-filter=".cat-4" href="#">Coloring</a></li>
                <li><a data-filter=".cat-5" href="#">Hair Wash</a></li>
            </ul>
        </div>
        <!-- PAGINATION END -->

        <!-- GALLERY CONTENT START -->
        <div class="masonry-wrap mfp-gallery row clearfix">
            <!-- COLUMNS 1 -->
            <div class="masonry-item cat-1 col-lg-4 col-md-6 col-sm-6 m-b30">

                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic1.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Pixie</h3>
                        <p class="title-style-2">Hair Products</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic1.jpg" class="mfp-link"></a>
                </div>


            </div>
            <!-- COLUMNS 2 -->
            <div class="masonry-item cat-2 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic2.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Colors</h3>
                        <p class="title-style-2">Hairstyle</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic2.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 3 -->
            <div class="masonry-item cat-3 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic4.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Braids</h3>
                        <p class="title-style-2">Hairstyle</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic4.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 4 -->
            <div class="masonry-item cat-4 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic3.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Keratin</h3>
                        <p class="title-style-2">Hairstyle</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic3.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 5 -->
            <div class="masonry-item cat-5 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic5.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Curls</h3>
                        <p class="title-style-2">Hairstyle</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic5.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 6 -->
            <div class="masonry-item cat-4 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic6.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Shades</h3>
                        <p class="title-style-2">Hairstyle</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic6.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 7 -->
            <div class="masonry-item cat-3 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic7.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Waves</h3>
                        <p class="title-style-2">Hair Products</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic7.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 5 -->
            <div class="masonry-item cat-2 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic8.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Tail</h3>
                        <p class="title-style-2">Hair Products</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic8.jpg" class="mfp-link"></a>
                </div>
            </div>
            <!-- COLUMNS 6 -->
            <div class="masonry-item cat-1 col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="project-img-effect-1">
                    <img src="<?php echo $theme_uri; ?>/images/gallery/thumb/pic9.jpg" alt="">
                    <div class="wt-info">
                        <h3 class="wt-tilte m-b10 m-t0">Layers</h3>
                        <p class="title-style-2">Coloring</p>
                    </div>
                    <i></i>
                    <a href="<?php echo $theme_uri; ?>/images/gallery/thumb/pic9.jpg" class="mfp-link"></a>
                </div>
            </div>
        </div>
        <!-- GALLERY CONTENT END -->
    </div>
</div>
<!-- GALLERY SECTION END -->

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>