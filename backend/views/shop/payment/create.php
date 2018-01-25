<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:11
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\PaymentMethod\PaymentMethodForm */

$this->title = 'Create Payment Method';
$this->params['breadcrumbs'][] = ['label' => 'PaymentMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="method-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
