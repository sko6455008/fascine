<?php
/**
 * Pricing Section Template Part
 *
 * @package Saloni
 */

$theme_uri = get_template_directory_uri();

// 料金メニューデータ
$menu_categories = array(
    array(
        'title' => 'Care',
        'subtitle' => 'ケア',
        'items' => array(
            array('name' => 'ネイルハンドケア', 'desc' => '所要時間30分,フィンガーバス＋甘皮処理＋整爪＋バッフィング＋シャイニング', 'price' => '¥3,550'),
            array('name' => 'パラフィンパック', 'desc' => '高濃度保湿パックで、肌を柔らかくすべすべにしてくれます。こちらのメニューは、単体のみでのご利用はお受けできません。', 'price' => '¥1,650'),
            array('name' => 'フットケア', 'desc' => '所要時間60分,フットバス＋整爪＋甘皮処理＋角質除去', 'price' => '¥6,500'),
            array('name' => 'メンズハンドケア', 'desc' => '所要時間40分,フィンガーバス,甘皮処理,ファイリング,バフィング or トップコート', 'price' => '¥3,850'),
            array('name' => 'メンズフットケア', 'desc' => '所要時間60分,フットバス,甘皮処理,ファイリング,バフィング又はトップコート仕上げ,角質処理は別途¥2,700円', 'price' => '¥6,600'),
        )
    ),
    array(
        'title' => 'Repair',
        'subtitle' => '自爪の修理・補強',
        'items' => array(
            array('name' => '補強(フロータ)', 'desc' => '1本あたり,アクリル素材のスカルプチュアで補強します', 'price' => '¥550'),
            array('name' => '補強(シルク)', 'desc' => '1本あたり,亀裂の部分にシルクで補強します', 'price' => '¥550'),
            array('name' => '長さ出し(アクリル)', 'desc' => '1本あたり', 'price' => '¥1,100'),
            array('name' => '長さ出し(ジェル)', 'desc' => '1本あたり', 'price' => '¥1,100'),
            array('name' => 'ルビケイト', 'desc' => '1本あたり,カビや菌の繁殖を防ぎ、グリーンネイルを予防する効果', 'price' => '¥150'),
        )
    ),
    array(
        'title' => 'Hand Gel',
        'subtitle' => 'ハンドジェル',
        'items' => array(
            array('name' => 'クリア', 'desc' => '所要時間30分,ファイル,甘皮処理,キューティクルオイル付き', 'price' => '¥4,400'),
            array('name' => 'ラメグラデーション', 'desc' => '所要時間60分', 'price' => '¥5,400'),
            array('name' => 'オフ込みワンカラー', 'desc' => '所要時間60分,ソフトジェルオフのみ対応,1色のみ選択可', 'price' => '¥6,000'),
            array('name' => 'カラーグラデーション', 'desc' => '所要時間60分', 'price' => '¥6,980'),
            array('name' => 'フレンチ', 'desc' => '所要時間60分,フレンチ形自由/ベース有フレンチ+¥1,000', 'price' => '¥7,480'),
            array('name' => 'マグネット', 'desc' => '所要時間60分', 'price' => '¥6,500'),
            array('name' => 'ガラスフレンチ', 'desc' => '所要時間70分', 'price' => '¥7,980'),
            array('name' => 'シンプル定額コース(アート込)', 'desc' => '所要時間60分', 'price' => '¥5,900'),
            array('name' => '一番人気定額コース(アート込)', 'desc' => '所要時間60分', 'price' => '¥6,900'),
            array('name' => 'こだわり定額コース(アート込)', 'desc' => '所要時間80分', 'price' => '¥8,400'),
            array('name' => 'ニュアンス定額コース', 'desc' => '所要時間60分', 'price' => '¥7,480'),
            array('name' => 'ワンホン定額コース', 'desc' => '所要時間80分', 'price' => '¥8,980'),
            array('name' => 'オフ込90分オーダーメイドコース', 'desc' => '長さ出し亀裂補強1本まで', 'price' => '¥8,980'),
            array('name' => 'オフ込120分オーダーメイドコース', 'desc' => '長さ出し亀裂補強3～4本まで', 'price' => '¥11,980'),
            array('name' => 'オフ込150分オーダーメイドコース', 'desc' => '長さ出し亀裂補強10本まで', 'price' => '¥14,980'),
        )
    ),
    array(
        'title' => 'Foot Gel',
        'subtitle' => 'フットジェル',
        'items' => array(
            array('name' => 'クリア', 'desc' => '所要時間30分,ファイル,甘皮処理,キューティクルオイル付き', 'price' => '¥4,900'),
            array('name' => 'ラメグラデーション', 'desc' => '所要時間60分', 'price' => '¥6,900'),
            array('name' => 'オフ込みワンカラー', 'desc' => '所要時間60分,ソフトジェルオフのみ対応,1色のみ選択可', 'price' => '¥6,500'),
            array('name' => 'シンプル定額コース(アート込)', 'desc' => '所要時間60分', 'price' => '¥6,900'),
            array('name' => '一番人気定額コース(アート込)', 'desc' => '所要時間60分', 'price' => '¥7,900'),
            array('name' => 'こだわり定額コース(アート込)', 'desc' => '所要時間80分', 'price' => '¥8,400'),
            array('name' => 'オフ込90分オーダーメイドコース', 'desc' => '長さ出し亀裂補強1本まで', 'price' => '¥9,980'),
            array('name' => 'オフ込120分オーダーメイドコース', 'desc' => '長さ出し亀裂補強3～4本まで', 'price' => '¥12,980'),
        )
    ),
    array(
        'title' => 'Nail Art',
        'subtitle' => 'ネイルアート',
        'items' => array(
            array('name' => 'ペイント', 'desc' => '1本あたり,アートはヒョウ・ダルメシアン・ハート・花・雪の結晶 etc.', 'price' => '¥440'),
            array('name' => 'ペイント', 'desc' => '1本あたり,アートはリボン・モチーフ・チェック etc.', 'price' => '¥550'),
            array('name' => 'パーツ', 'desc' => '1本あたり', 'price' => '¥110～'),
            array('name' => 'スワロ', 'desc' => '1本あたり', 'price' => '¥110～'),
            array('name' => '3Dアート', 'desc' => '1本あたり', 'price' => '¥550'),
            array('name' => 'ラメライン', 'desc' => '1本あたり', 'price' => '¥110'),
            array('name' => 'ホロチラシ', 'desc' => '1本あたり', 'price' => '¥170'),
            array('name' => 'ホロ埋めつくし', 'desc' => '1本あたり', 'price' => '¥440'),
            array('name' => 'ホロフレンチ', 'desc' => '1本あたり', 'price' => '¥330'),
            array('name' => 'ラメ追加', 'desc' => '1本あたり', 'price' => '¥110'),
        )
    ),
    array(
        'title' => 'Off Only',
        'subtitle' => 'オフのみ',
        'items' => array(
            array('name' => 'ポリッシュオフ', 'desc' => '所要時間5分,10本あたり', 'price' => '¥330'),
            array('name' => 'ソフトジェルオフ', 'desc' => '所要時間30分,10本あたり,付け替え時は¥1,100～', 'price' => '¥3,300'),
            array('name' => 'スカルプチュアオフ', 'desc' => '所要時間40分,10本あたり,付け替え時は¥2,200～', 'price' => '¥3,980'),
        )
    ),
);

// 2列に分割するためにカテゴリを配列に分ける
$total_categories = count($menu_categories);
?>

<!-- PRICING SECTION START -->
<div class="section-full p-t80 p-b50 bg-orange-light bg-brush-img">
    <div class="container">
        <div class="section-content">

            <!-- TITLE START-->
            <div class="center wt-small-separator-outer section-head">
                <div class="wt-small-separator">
                    <div class="sep-leaf-left"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-left.png" alt="">
                    </div>
                    <div>
                        <?php esc_html_e('Pricing Menu', 'saloni'); ?>
                    </div>
                    <div class="sep-leaf-right"><img src="<?php echo $theme_uri; ?>/images/sep-leaf-right.png" alt="">
                    </div>
                </div>
                <h2 data-title="<?php esc_attr_e('Menu', 'saloni'); ?>">
                    <?php esc_html_e('Menu', 'saloni'); ?>
                </h2>
            </div>
            <!-- TITLE END-->

            <div class="row justify-content-center">

                <?php foreach ($menu_categories as $index => $category) : ?>
                <div class="col-lg-6 col-md-12 col-sm-12 m-b30">

                    <div class="pricing-list-block bg-white p-a20">
                        <div class="pricing-list-header">
                            <h3 class="pricing-category-title"><?php echo esc_html($category['title']); ?></h3>
                            <p class="pricing-category-subtitle"><?php echo esc_html($category['subtitle']); ?></p>
                        </div>

                        <ul>
                            <?php foreach ($category['items'] as $item) : ?>
                            <li>
                                <div class="price-list-info">
                                    <h3>
                                        <?php echo esc_html($item['name']); ?>
                                    </h3>
                                    <p>
                                        <?php echo esc_html($item['desc']); ?>
                                    </p>
                                </div>
                                <div class="price-list-amount">
                                    <h3 class="text-black"><span class="amount-price"><?php echo esc_html($item['price']); ?></span></h3>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>

<style>
/* 全体の余白調整 */
.section-full.p-t80 {
    padding-top: 50px !important;
}
.section-full.p-b50 {
    padding-bottom: 30px !important;
}

/* カラム間の余白 */
.col-lg-6.m-b30 {
    margin-bottom: 20px !important;
}

/* カードの余白 */
.pricing-list-block.p-a20 {
    padding: 15px !important;
}

/* ヘッダー */
.pricing-list-header {
    text-align: center;
    margin-bottom: 10px;
}
.pricing-category-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 3px;
    color: #333;
}
.pricing-category-subtitle {
    font-size: 12px;
    color: #888;
    margin: 0;
}

/* リストアイテム */
.pricing-list-block ul {
    margin: 0;
    padding: 0;
}
.pricing-list-block ul li {
    padding: 8px 0 !important;
    margin-bottom: 0 !important;
}
.pricing-list-block .price-list-info h3 {
    font-size: 14px;
    margin-bottom: 2px;
}
.pricing-list-block .price-list-info p {
    font-size: 11px;
    margin-bottom: 0;
    line-height: 1.4;
}
.pricing-list-block .price-list-amount h3 {
    font-size: 14px;
}
.pricing-list-block .amount-price {
    font-size: 14px;
}

/* セクションヘッダーの余白 */
.section-head {
    margin-bottom: 25px !important;
}
</style>
<!-- PRICING SECTION END -->