<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 10:39
 */

/* @var $cart \core\cart\Cart */

use core\helpers\PriceHelper;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="header_cart_wrp">
    <?php if ($cart->getItems()): ?>
        <div class="cart cart_full">
            <span class="cart__icon cart__icon_full"> <span><?= $cart->getAmount() ?></span> </span>
            <p class="cart__title">Корзина</p>
            <p class="cart__amount"><?= PriceHelper::format($cart->getCost()->getTotal()) ?></p>
        </div>
    <?php else: ?>
        <div class="cart cart_empty">
            <span class="cart__icon"></span>
            <p class="cart__title">Корзина</p>
            <p class="cart-items">ПОКА ПУСТА</p>
        </div>
    <?php endif; ?>
</div>

<a href="<?= Url::to(['/shop/cart/index']) ?>" class="checkout btn">
    оформить
</a>
<div class="cart__inside">
    <?php foreach ($cart->getItems() as $item): ?>
    <?php
    $product = $item->getProduct();
    $modification = $item->getModification();
    $cost = $cart->getCost();
    $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
    ?>
        <div class="cart__item">
            <?php if ($product->mainPhoto): ?>
                <a href="<?= $url ?>">
                    <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_widget_list') ?>" alt="" class="img-thumbnail" />
                </a>
            <?php endif; ?>
<!--            <p class="cart__product-icon"></p>-->
            <div class="wrapper">
                <p class="cart__product-name"><a href="<?= $url ?>"><?= Html::encode($product->name) ?></a></p>
                <div class="wrapper_product">
                    <p class="cart__product-price"><?= PriceHelper::format($item->getCost()) ?></p>
                    <p class="cart__product-amount"><?= $item->getQuantity() ?> шт</p>
                </div>
                <a href="<?= Url::to(['/shop/cart/remove', 'id' => $item->getId()]) ?>" title="Remove" class="" data-method="post"><i class="fa fa-times"></i></a>
            </div>
        </div>
    <?php endforeach ?>
</div>