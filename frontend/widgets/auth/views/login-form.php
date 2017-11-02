<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 02.11.17
 * Time: 10:28
 */
/** @var $model \core\forms\auth\LoginForm; */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/login']); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

    <div class="row">
        <div class="col-sm-6">
            <label >
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </label>

        </div>
        <div class="col-sm-6">
            <?= Html::a(Html::button('Forgot password', ['class' => 'btn-link forget']), ['auth/reset/request']) ?>
        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-sm-6">
            <?= Html::submitButton('Login', ['class' => 'btn enter', 'name' => 'login-button']) ?>
        </div>
        <div class="col-sm-6">
            <?= Html::a('Register', Html::encode(Url::to(['/signup'])), ['class' => 'btn-link reg'] ) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
