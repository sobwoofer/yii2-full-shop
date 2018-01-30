<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.01.18
 * Time: 16:48
 */

/**
 * @var \core\forms\Shop\Order\OrderForm $model
 * @var $this yii\web\View
 */

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use core\entities\User\User;
use core\helpers\UserHelper;

?>


<?php $form = ActiveForm::begin() ?>

    <p class="form-title">Заполните контактные данные</p>

<?= $this->render('_customer-forms/' . UserHelper::getOrderFormOfUserType(), ['form' => $form, 'model' => $model]) ?>


<?= $form->field($model, 'note')->textarea([
    'rows' => 3,
    'cols' => 30,
    'placeholder' => 'Comment for order'])->label(false) ?>


    <p class="info"><span class="red">*</span> поля обязательные к заполнению</p>
    <p class="form-title">Заполните контактные данные</p>


    <div class="wrp-input">
        <p class="wrp-input-title">Способ доставки</p>
        <?= $form->field($model->delivery, 'method')
            ->dropDownList($model->delivery->deliveryMethodsList(), ['prompt' => '--- Select ---'])
            ->label(false) ?>

        <a href="#/" class="wrp-input_more">подробнее</a>
    </div>
<?php Pjax::begin(['id' => 'deliveryPjaxSection']); ?>
    <div class="wrp-input">
        <p class="wrp-input-title">Способ оплаты</p>

        <?= $form->field($model->payment, 'method', ['options' => ['class' => 'field-deliveryform-method']])
            ->dropDownList($model->payment->paymentMethodsList(), ['prompt' => '--- Select ---'])
            ->label(false) ?>

        <!--                        <input type="text" placeholder="Безналичны расчет">-->
        <a href="#/" class="wrp-input_more">подробнее</a>
    </div>
<?php Pjax::end(); ?>

    <div class="adress-wrp">
        <input type="text" placeholder="№ офиса" class="pull-left">
        <input type="text" placeholder="№ этажа" class="pull-right">
        <div class="clearfix"></div>
    </div>
    <input type="submit" value="Оформить заказ" href="index.php?route=checkout/checkout" class="btn uppercase">

<?php ActiveForm::end() ?>