<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:12
 */

/* @var $this yii\web\View */
/* @var $method core\entities\Shop\PaymentMethod\PaymentMethod */
/* @var $model core\forms\manage\Shop\PaymentMethod\PaymentMethodForm */

$this->title = 'Update Payment Method: ' . $method->name;
$this->params['breadcrumbs'][] = ['label' => 'PaymentMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $method->name, 'url' => ['view', 'id' => $method->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
