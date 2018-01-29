<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.01.18
 * Time: 17:19
 */

/**
 * @var $this yii\web\View
 * @var $form \yii\widgets\ActiveForm
 * @var $model \core\forms\Shop\Order\OrderForm
 */

?>

<?= $form->field($model->customer, 'username')->textInput([
    'placeholder' => 'First Name'])->label(false) ?>

<?= $form->field($model->customer, 'email')->textInput([
    'placeholder' => 'Phone number'])->label(false) ?>

<?= $form->field($model->customer, 'phone')->textInput([
    'placeholder' => 'Phone number'])->label(false) ?>
