<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:29
 */

/* @var $this yii\web\View */
/* @var $warehouse core\entities\Shop\Warehouse */
/* @var $model core\forms\manage\Shop\WarehouseForm */

$this->title = 'Update Warehouse: ' . $warehouse->name;
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $warehouse->name, 'url' => ['view', 'id' => $warehouse->id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
