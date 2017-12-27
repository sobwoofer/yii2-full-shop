<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\helpers\ModificationAssignmentHelper;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\Product\ModificationAssignmentsForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList(null, null, $model->getGroupList(), ['id' => 'groupId', 'class' => 'form-control']) ?>
    <?= $form->field($model, 'modificationId')->dropDownList([], ['prompt' => 'Select group', 'id' => 'modificationId']) ?>
    <?= $form->field($model, 'minQty')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(ModificationAssignmentHelper::statusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script type="text/javascript">
        setTimeout(function(){
            $('#groupId').on('change', function () {
                $.ajax('/shop/modification-assign/get-modifications-of-group-id?id=' + this.value, {
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#modificationId').empty();
                            $.each(data.modifications, function (key, val) {

                                $('#modificationId').append('<option value="'+key+'">'+val+'</option>');
                            });
                        }
                    }
                });
            });
        }, 200);
    </script>

</div>
