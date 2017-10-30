<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 14:37
 */

use romkaChev\yii2\swiper\Swiper;
use yii\helpers\Url;
/** @var $products core\entities\Shop\Product\Product[] */
/** @var $title string */
/** @var $class string */
/** @var $viewAll string */
?>

<div class="product-line <?= $class ?>">
    <div class="container">
        <div class="row">
            <div class="product-line__title__wrp">
                <p class="product-line__title"><?= $title ?></p>
                <?php if ($viewAll): ?>
                    <a href="<?= Url::to([$viewAll]) ?>" class="read_more">смотреть <span></span></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
        $data = [];
        foreach ($products as $product) {
            $data[] = $this->render('@frontend/views/shop/catalog/_product', ['product' => $product]);
        } ?>
        <?= Swiper::widget( [
            'items'         => $data,
            'behaviours'    => [
                'nextButton',
                'prevButton'
            ],
            'pluginOptions' => [
                'grabCursor'     => true,
                'slidesPerView'  => 4,
                'effect'         => 'slide',
                'autoplay'=> 4000,
                'paginationClickable' => true,
                'breakpoints' => [
                     480 => [
                         'slidesPerView' => 1,
                         'spaceBetween' => 20
                     ],
                     900 => [
                         'slidesPerView' => 2
                     ],
                     1100 => [
                         'slidesPerView' => 3
                     ],
                     1200 => [
                         'slidesPerView' => 4
                     ],
                     1390 => [
                         'slidesPerView' => 5
                     ],
                     1400 => [
                         'slidersPreView' => 6
                     ]
                     // 1920: {
                     //     slidesPerView: 5
                     // }
                    ],
                'spaceBetween' => 30
            ]
        ] ); ?>

    </div>
</div>
