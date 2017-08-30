<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:01
 */

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $model core\forms\manage\Shop\Product\ModificationForm */

$this->title = 'Create Modification';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
