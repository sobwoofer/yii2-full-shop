<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 14:31
 */

use romkaChev\yii2\swiper\Swiper;
use yii\helpers\Url;

/** @var $products core\entities\Shop\Product\Product[][] */
/** @var $title1 string */
/** @var $title2 string */
/** @var $title3 string */
/** @var $class string */
/** @var $viewLink1 string */
/** @var $viewLink2 string */
/** @var $viewLink3 string */
?>
<!-- // TODO need refactoring this code to cycle -->
<div class="product-line  <?= $class ?>">
    <div class="product-line__tabs__wrp">
        <!-- Nav tabs -->
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="col-md-4" id="tabBtn1">
                        <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                            <div class="product-line__title__wrp">
                                <p class="product-line__title"><?= $title1 ?></p>
                                <?php if ($viewLink1): ?>
                                    <p onclick="document.location.href = '<?= Url::to([$viewLink1]) ?>'" class="more">смотреть все<span></span></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                    <li role="presentation" class="active col-md-4" id="tabBtn2">
                        <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
                            <div class="product-line__title__wrp">
                                <p class="product-line__title"><?= $title2 ?></p>
                                <?php if ($viewLink2): ?>
                                    <p onclick="document.location.href = '<?= Url::to([$viewLink2]) ?>'" class="more">смотреть все<span></span></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                    <li role="presentation" class="col-md-4" id="tabBtn3">
                        <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">
                            <div class="product-line__title__wrp">
                                <p class="product-line__title"><?= $title3 ?></p>
                                <?php if ($viewLink3): ?>
                                    <p onclick="document.location.href = '<?= Url::to([$viewLink3]) ?>'" class="more">смотреть все<span></span></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane " id="tab-1">
                <?php
                $data = [];
                foreach ($products['content1'] as $product) {
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
                        ],
                        'spaceBetween' => 30
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
                        ],
                        'spaceBetween' => 30
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
                        ],
                        'spaceBetween' => 30
                    ]
                ] ); ?>
            </div>
        </div>
    </div>
</div>
