<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:02
 */

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $modification core\entities\Shop\Product\Modification */
/* @var $model core\forms\manage\Shop\Product\ModificationForm */

$this->title = 'Update Modification: ' . $modification->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>
<div class="modification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>