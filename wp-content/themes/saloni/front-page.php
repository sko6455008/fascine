<?php
/**
 * Front Page Template
 *
 * @package Saloni
 */

get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- FIRST VIEW START -->
<div class="first-view-section">
    <div class="first-view-video-wrap">
        <video autoplay muted loop playsinline class="first-view-video">
            <source src="<?php echo $theme_uri; ?>/movie/first-view.mp4" type="video/mp4">
        </video>
        <div class="first-view-overlay"></div>
    </div>
    <div class="first-view-content">
        <p class="first-view-subtitle">Concept</p>
        <h1 class="first-view-title">特別なひとときを</h1>
        <p class="first-view-description">経験豊富なネイリストが、あなたに合わせた、品のある洗練されたデザインをご提案します。</p>
        <a href="https://071f0f.b-merit.jp/pJ3MHW/web" class="first-view-btn">予約する</a>
    </div>
</div>
<style>
    .first-view-section {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .first-view-video-wrap {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .first-view-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .first-view-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .first-view-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
        width: 90%;
        max-width: 700px;
    }

    .first-view-subtitle {
        font-family: 'Great Vibes', cursive;
        font-size: 48px;
        color: #fff;
        margin-bottom: 10px;
        opacity: 0;
        animation: fadeInUp 1.2s ease-out 0.3s forwards;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .first-view-title {
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 72px;
        font-weight: 400;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
        opacity: 0;
        animation: fadeInUp 1.2s ease-out 0.8s forwards;
    }

    .first-view-description {
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 20px;
        font-weight: 500;
        color: #fff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        line-height: 1.6;
        margin-bottom: 30px;
        opacity: 0;
        animation: fadeInUp 1.2s ease-out 1.3s forwards;
    }

    .first-view-btn {
        display: inline-block;
        padding: 14px 40px;
        background-color: #541f5c;
        color: #fff;
        border-radius: 30px;
        text-decoration: none;
        font-family: 'Noto Sans JP', sans-serif;
        font-size: 16px;
        letter-spacing: 1px;
        transition: opacity 0.3s ease, transform 0.3s ease;
        opacity: 0;
        animation: fadeInUp 1.2s ease-out 1.8s forwards;
    }

    .first-view-btn:hover {
        opacity: 0.85 !important;
        transform: translateY(-2px);
        color: #fff;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media only screen and (max-width: 768px) {
        .first-view-subtitle {
            font-size: 34px;
        }

        .first-view-title {
            font-size: 38px;
        }

        .first-view-description {
            font-size: 16px;
            line-height: 1.5;
        }
    }
</style>
<!-- FIRST VIEW END -->

<?php get_template_part('template-parts/home/welcome-section'); ?>
<?php get_template_part('template-parts/home/menu-section'); ?>
<?php get_template_part('template-parts/home/gallery-section'); ?>
<?php get_template_part('template-parts/home/coupon-section'); ?>
<?php get_template_part('template-parts/home/blog-section'); ?>
<?php get_template_part('template-parts/home/instagram-section'); ?>

<!-- BUTTON TOP START -->
<button class="scroltop"><span class="fa fa-angle-up relative" id="btn-vibrate"></span></button>

<?php get_footer(); ?>