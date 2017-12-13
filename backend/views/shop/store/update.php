<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:29
 */

/* @var $this yii\web\View */
/* @var $store core\entities\Shop\Store */
/* @var $model core\forms\manage\Shop\StoreForm */

$this->title = 'Update Store: ' . $store->name;
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $store->name, 'url' => ['view', 'id' => $store->id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
