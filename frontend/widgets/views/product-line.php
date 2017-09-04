<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 14:37
 */

use romkaChev\yii2\swiper\Swiper;

/** @var $products core\entities\Shop\Product\Product[] */
/** @var $title string */
/** @var $class string */
?>

<div class="product-line <?= $class ?>">
    <div class="container">
        <div class="row">
            <div class="product-line__title__wrp">

                <div class="col-sm-4">
                    <p class="product-line__title"><?= $title ?></p>
                </div>
                <div class="col-md-2">
                    <a href="#" class="read_more">смотреть <span></span></a>
                </div>
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
                'centeredSlides' => true,
                'slidesPerView'  => 'auto',
                'effect'         => 'coverflow',
                'coverflow'      => [
                    'rotate'       => 50,
                    'stretch'      => 0,
                    'depth'        => 100,
                    'modifier'     => 2,
                    'slideShadows' => true
                ]
            ]
        ] ); ?>

    </div>
</div>
