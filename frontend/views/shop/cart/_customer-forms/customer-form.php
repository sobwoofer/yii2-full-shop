<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.01.18
 * Time: 16:41
 */

/**
 * @var $this yii\web\View
 * @var $form \yii\widgets\ActiveForm
 * @var $model \core\forms\Shop\Order\OrderForm
 */

?>

<?= $form->field($model->customer, 'firstName')->textInput([
    'placeholder' => 'First Name'])->label(false) ?>

<?= $form->field($model->customer, 'lastName')->textInput([
    'placeholder' => 'Last Name'])->label(false) ?>

<?= $form->field($model->customer, 'email')->textInput([
    'placeholder' => 'Email'])->label(false) ?>

<?= $form->field($model->customer, 'address')->textInput([
    'placeholder' => 'Address'])->label(false) ?>

<?= $form->field($model->customer, 'phone')->textInput([
    'placeholder' => 'Phone number'])->label(false) ?>


