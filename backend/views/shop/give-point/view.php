<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:36
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $givePoint core\entities\Shop\GivePoint */

$this->title = $givePoint->name;
$this->params['breadcrumbs'][] = ['label' => 'GivePoints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $givePoint->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $givePoint->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $givePoint,
                'attributes' => [
                    'id',
                    'name',
                    'description',
                    'slug',
                    'store.name',
                    'warehouse.name',
                ],
            ]) ?>
        </div>
    </div>

</div>

