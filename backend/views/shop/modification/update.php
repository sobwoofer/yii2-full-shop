<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:02
 */

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $modification core\entities\Shop\Modification\Modification */
/* @var $model core\forms\manage\Shop\Modification\ModificationForm */

$this->title = 'Update Modification: ' . $modification->name;
$this->params['breadcrumbs'][] = ['label' => 'Modifications', 'url' => ['shop/modification/index']];
$this->params['breadcrumbs'][] = ['label' => $modification->name, 'url' => ['shop/modification/view', 'id' => $modification->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>
<div class="modification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>