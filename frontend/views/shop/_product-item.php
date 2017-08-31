<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 10:53
 */
?>

<div class="product-line__item">
    <!-- .stock -->
    <div class="stock">
        <p class="stock__title">Цена
            <br>недели</p>
        <div class="stock__discount">
            -20%
        </div>
    </div>
    <!-- .stock -->
    <!-- .product-line__item__logo -->
    <div class="product-line__item__logo">
        <img src="images/product-logo.png" alt="">
    </div>
    <!-- .product-line__item__logo -->
    <!-- .product-line__img -->
    <div class="product-line__img">
        <img src="images/product-img-1.png" alt="">
    </div>
    <!-- .product-line__img -->
    <!-- .product-line__title -->
    <div class="product-line__title">
        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
    </div>
    <!-- .product-line__title -->
    <span class="vendor_code">Артикул: s101003</span>
    <!-- .price_block -->
    <div class="price_block price_stock
        ">
        <p class="price_old">216.99</p>
        <p class="prace_new">215. <span>99</span> грн</p>
    </div>
    <!-- .price_block -->
    <!-- .product-line__item__action-block -->
    <div class="product-line__item__action-block">
        <a href="#" class="like">
            <i class="fa fa-heart" aria-hidden="true"></i>
        </a>
        <input type="number" value="1">
        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
    </div>
    <div class="clearfix"></div>
    <?= \alfa6661\widgets\Raty::widget([
        'name' => 'user-vote',
        'options' => [
            'class' => 'star',
            'id' => 'user-vote'
        ],
        'pluginOptions' => [
            'click' => new \yii\web\JsExpression('function(score, e) {
                                            alert(score);
                                        }')
        ]
    ]); ?>
    <!-- .product-line__item__action-block -->
    <div class="review">
        <a href="#" class="pull-right">Оставить отзыв</a>
    </div>
</div>
