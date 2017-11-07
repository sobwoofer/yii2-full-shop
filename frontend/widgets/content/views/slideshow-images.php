<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.11.17
 * Time: 15:56
 */

use romkaChev\yii2\swiper\Swiper;
use yii\helpers\Html;

?>

<?= Swiper::widget( [
    'items'         => [
        Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
        Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
        Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
        Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
        Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
        Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png')
    ],
    'behaviours'    => [
        'pagination',
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
            'modifier'     => 1,
            'slideShadows' => true
        ]
    ]
] ); ?>
