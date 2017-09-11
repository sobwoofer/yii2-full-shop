<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:11
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\DeliveryMethodForm */

$this->title = 'Create Delivery Method';
$this->params['breadcrumbs'][] = ['label' => 'DeliveryMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="method-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
