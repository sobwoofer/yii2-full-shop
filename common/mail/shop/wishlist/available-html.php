<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.10.17
 * Time: 13:12
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \core\entities\User\User */
/* @var $product \core\entities\Shop\Product\Product */

$link = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['shop/catalog/product', 'id' => $product->id]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Product from your wishlist is available right now:</p>

    <p><?= Html::a(Html::encode($link), $link) ?></p>
</div>
