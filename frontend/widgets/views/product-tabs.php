<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 14:31
 */

use romkaChev\yii2\swiper\Swiper;

/** @var $products core\entities\Shop\Product\Product[][] */
/** @var $title1 string */
/** @var $title2 string */
/** @var $title3 string */
/** @var $class string */
?>
<!-- // TODO need refactoring this code to cycle -->
<div class="product-line  <?= $class ?>">
    <div class="product-line__tabs__wrp">
        <!-- Nav tabs -->
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="col-md-4">
                    <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                        <div class="product-line__title__wrp">
                            <p class="product-line__title"><?= $title1 ?></p>
                            <p onclick="document.location.href = '#1'" class="more">смотреть все<span></span></p>
                        </div>
                    </a>
                </li>
                <li role="presentation" class="active col-md-4">
                    <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
                        <div class="product-line__title__wrp">
                            <p class="product-line__title"><?= $title2 ?></p>
                            <p onclick="document.location.href = '#2'" class="more">смотреть все<span></span></p>
                        </div>
                    </a>
                </li>
                <li role="presentation" class="col-md-4">
                    <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">
                        <div class="product-line__title__wrp">
                            <p class="product-line__title"><?= $title3 ?></p>
                            <p onclick="document.location.href = '#3'" class="more">смотреть все<span></span></p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane " id="tab-1">
                <?php
                $data = [];
                foreach ($products['content1'] as $product) {
                    $data[] = $this->render('/shop/catalog/_product', ['product' => $product]);
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
//                        'effect'         => 'coverflow',
//                        'coverflow'      => [
//                            'rotate'       => 50,
//                            'stretch'      => 0,
//                            'depth'        => 100,
//                            'modifier'     => 2,
//                            'slideShadows' => true
//                        ]
                    ]
                ] ); ?>
            </div>
            <div role="tabpanel" class="tab-pane active" id="tab-2">
                <?php
                $data = [];
                foreach ($products['content2'] as $product) {
                    $data[] = $this->render('/shop/catalog/_product', ['product' => $product]);
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
            <div role="tabpanel" class="tab-pane" id="tab-3">
                <?php
                $data = [];
                foreach ($products['content3'] as $product) {
                    $data[] = $this->render('/shop/catalog/_product', ['product' => $product]);
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
    </div>
</div>
