<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.10.17
 * Time: 11:47
 */
/** @var $title string */
/** @var $class string */
/** @var $banners [] */

use romkaChev\yii2\swiper\Swiper;

?>


<div class="<?= $class ?>">
    <div class="container">
        <p class="<?= $class ?>__title"><?= $title ?></p>
        <?= Swiper::widget( [
            'items'         => $banners,
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
