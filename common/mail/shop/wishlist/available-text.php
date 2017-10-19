<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.10.17
 * Time: 13:13
 */

/* @var $this yii\web\View */
/* @var $user \core\entities\User\User */
/* @var $product \core\entities\Shop\Product\Product */

$link = Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(['shop/catalog/product', 'id' => $product->id]);
?>
    Hello <?= $user->username ?>,

    Product from your wishlist is available right now:

<?= $link ?>