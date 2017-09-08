<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 10:53
 */

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */

use core\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$url = Url::to(['catalog/product', 'id' =>$product->id]);
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
        <img src="http://static.yii2-shop.dev/dev/product-logo.png" alt="">
    </div>
    <!-- .product-line__item__logo -->
    <!-- .product-line__img -->
    <div class="product-line__img">
        <div class="image">
            <a href="<?= Html::encode($url) ?>">
                <?php if ($product->mainPhoto): ?>
                    <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>" alt="" class="img-responsive" />
                <?php else: ?>
                    <img src="http://static.yii2-shop.dev/dev/product-img-1.png" alt="">
                <?php endif; ?>
            </a>
        </div>
    </div>
    <!-- .product-line__img -->
    <!-- .product-line__title -->
    <div class="product-line__title">
        <p><a href="<?= Html::encode($url) ?>"><?= StringHelper::truncateWords(Html::encode($product->name), 20) ?></a></p>
    </div>
    <!-- .product-line__title -->
    <span class="vendor_code">Артикул: s101003</span>
    <!-- .price_block -->
    <div class="price_block price_stock
        ">
        <p class="prace_new"><?= PriceHelper::format($product->price_new) ?></p>
        <?php if ($product->price_old): ?>
            <p class="price_old"><?= PriceHelper::format($product->price_old) ?></p>
        <?php endif; ?>

    </div>
    <!-- .price_block -->
    <!-- .product-line__item__action-block -->
    <div class="product-line__item__action-block">
<!--        //TODO need response login or not login and isset in woshlist, add or delete-->
        <a href="#" onclick="wishlist.add('<?= $product->id ?>');" class="like">
            <i class="fa fa-heart" aria-hidden="true"></i>
        </a>
        <input type="number" value="1">
        <a href="#" onclick="cart.add('<?= $product->id ?>', '2');" class="btn btn-to-cart">В КОРЗИНУ</a>
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
