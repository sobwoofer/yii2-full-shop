<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:29
 */

/* @var $this yii\web\View */
/* @var $givePoint core\entities\Shop\GivePoint */
/* @var $model core\forms\manage\Shop\GivePointForm */

$this->title = 'Update Give point: ' . $givePoint->name;
$this->params['breadcrumbs'][] = ['label' => 'Give points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $givePoint->name, 'url' => ['view', 'id' => $givePoint->id]];
$this->params['breadcrumbs'][] = 'Update';
?>



<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
