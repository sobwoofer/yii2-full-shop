<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\User\UserCreateForm */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxLength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>

</div>
