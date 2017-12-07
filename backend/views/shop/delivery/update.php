<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:12
 */

/* @var $this yii\web\View */
/* @var $method core\entities\Shop\DeliveryMethod\DeliveryMethod */
/* @var $model core\forms\manage\Shop\DeliveryMethodForm */

$this->title = 'Update Delivery Method: ' . $method->name;
$this->params['breadcrumbs'][] = ['label' => 'DeliveryMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $method->name, 'url' => ['view', 'id' => $method->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
