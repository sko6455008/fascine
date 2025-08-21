<?php
/**
 * Template Name: Access
 */
get_header();
?>

<div class="page-header">
    <div class="headline-area">
        <h1 class="headline">Access</h1>
        <p class="title">アクセス</p>
    </div>
</div>

<div class="container">  
    <div class="row mb-5">
        <div class="section">
            <div class="text-area">
                <h2 class="main-text">木の温もりを感じる落ち着いた雰囲気のプライベート空間</h2>
                <p class="sub-text">
                    周りを気にすることなく、ゆったりとくつろぎながら、ネイリストとの会話や、自分だけの美しさを追求する時間を満喫していただけます。
                    施術には、厳選された高品質な材料を使用し、お客様一人ひとりのライフスタイルや好みに合わせたデザインをご提案。
                    指先から心まで満たされるような贅沢なネイル体験をお届けします。
                </p>
            </div>

            <div class="access-content">
                <div class="item">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.7086482756745!2d139.70674961534667!3d35.73338328018222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188d5ef5ffc2e9%3A0x45a6139e479940e8!2z77ymYXNjaW5h!5e0!3m2!1sja!2sjp!4v1561524155592!5m2!1sja!2sjp" 
                        width="100%" 
                        height="500" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="button-area">
                    <a class="link-button" href="https://www.google.com/maps/place/%E3%83%95%E3%82%A1%E3%83%83%E3%82%B7%E3%83%BC%E3%83%8A%E6%B1%A0%E8%A2%8B/@35.7333719,139.7089103,17z/data=!3m1!4b1!4m6!3m5!1s0x60188d5ef5ffc2e9:0x45a6139e479940e8!8m2!3d35.7333719!4d139.7089103!16s%2Fg%2F1tfkfl50?entry=ttu&g_ep=EgoyMDI1MDgxMy4wIKXMDSoASAFQAw%3D%3D" target="_blank">大きな地図で表示する</a>
                </div>

                <div class="item">
                    <h3 class="access-title">
                        住所
                    </h3>
                    <p class="access-content">
                        東京都豊島区池袋2-40-13VORT池袋ビル3F
                    </p>
                </div>
                <div class="item">
                    <h3 class="access-title">
                        営業時間
                    </h3>
                    <p class="access-content">
                        平日 11:00 ～ 21:00<br>
                        土日祝 10:00 ～ 20:00<br>
                        ※年中無休
                    </p>
                </div>
                <div class="item">
                    <h3 class="access-title">
                        電話番号
                    </h3>
                    <p class="access-content">
                        <span class="tel">TEL.</span>
                        <a href="tel:050-5305-3298" class="phone-link">050-5305-3298</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ページヘッダー */
    .page-header {
        background: url("<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/slide.jpg") no-repeat center center;
        background-size: cover;
        width: 100%;
        height: 420px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 70px;
    }
    .headline-area {
        max-width: 800px;
        position: relative;
        z-index: 1;
        text-align: center;
        color: #fff;
    }
    .headline,.title {
        text-shadow: 1px 1px 5px #735E59;
    }

    /* Accessセクション */
    .container {
        padding: 100px 0px;
    }
    .section {
        background: #fff;
        height: 100%;
    }
    .image-area {
        display: flex;
        gap: 1px;
        margin-bottom: 40px;
    }
    .image-area-top {
        height: 300px;
        width: 100%;
        object-fit: cover;
    }
    
    .text-area {
        text-align: center;
        margin-bottom: 30px;
        padding: 0 20px;
    }
    .main-text {
        font-size: 28px;
        color: #735E59;
        margin: 25px 0px;
        font-weight: 600;
        line-height: 1.4;
        font-family: "ヒラギノ角ゴ W3", "游ゴシック体", "Yu Gothic", "メイリオ", sans-serif;
    }
    .sub-text {
        font-size: 16px;
        color: #666;
        line-height: 1.8;
        max-width: 800px;
        margin: 0 auto;
        font-family: "ヒラギノ角ゴ W3", "游ゴシック体", "Yu Gothic", "メイリオ", sans-serif;
    }
    .item {
        padding: 20px;
        text-align: center;
    }
    .button-area {
        padding-bottom: 10px;
        text-align: center;
    }
    .access-title {
        font-size: 18px;
        color: #735E59;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .access-content {
        margin: 0px;
        font-size: 15px;
        font-family: "ヒラギノ角ゴ W3", "游ゴシック体", "Yu Gothic", "メイリオ", sans-serif;
    }
    .link-button {
        color: #735E59;
        background-color: #fff;
        text-decoration: none;
        border: 1px solid #735E59;
        display: block;
        width: 230px;
        margin: 0 auto;
        padding: 15px;
    }
    .tel {
        font-size: 15px;
        color: #735E59;
    }
    .phone-link {
        font-size: 27px;
        color: #735E59;
        text-decoration: none;
        font-weight: 600;
    }

    /* レスポンシブデザイン */
    @media (max-width: 768px) {
        .section {
            padding: 20px;
        }
        .main-text {
            font-size: 24px;
        }
        .sub-text {
            font-size: 15px;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 0 15px;
        }
        .text-area {
            padding: 0 10px;
        }
        .main-text {
            font-size: 20px;
        }
    }
</style>

<?php get_footer(); ?>
