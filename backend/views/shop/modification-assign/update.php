<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\helpers\ModificationAssignmentHelper;

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $modification core\entities\Shop\Modification\Modification */
/* @var $model core\forms\manage\Shop\Product\ModificationAssignmentsForm */

$this->title = 'Update ModificationAssign: ' . $modification->name . ' of: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>
<div class="modification-update">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'minQty')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(ModificationAssignmentHelper::statusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
