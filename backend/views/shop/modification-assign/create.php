<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\helpers\ModificationAssignmentHelper;

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $model core\forms\manage\Shop\Product\ModificationAssignmentsForm */

$this->registerJsFile('/js/shop/modification/createAssignment.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Assign Modification to: '. $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modification-assign-create">
    <?php $form = ActiveForm::begin(); ?>
        <?= Html::dropDownList(null, null, $model->getGroupList(), ['id' => 'groupId', 'class' => 'form-control']) ?>
        <?= $form->field($model, 'modificationId')->dropDownList([], ['prompt' => 'Select group', 'id' => 'modificationId']) ?>
        <?= $form->field($model, 'minQty')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(ModificationAssignmentHelper::statusList()) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
