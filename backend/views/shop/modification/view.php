<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 16:39
 */

/* @var $this yii\web\View */
/* @var $modification \core\entities\Shop\Modification\Modification */

use yii\helpers\Html;
use yii\widgets\DetailView;

//$this->title = $modification->name;
$this->title = 'View Modification';
$this->params['breadcrumbs'][] = ['label' => 'Modifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="modification-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $modification->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $modification->id], [
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
                'model' => $modification,
                'attributes' => [
                    'id',
                    'name',
                    'code',
                    'price',
                    'manager_id',
                    [
                        'attribute' => 'status',
                        'value' => \core\helpers\ModificationHelper::statusLabel($modification->status),
                        'format' => 'raw',
                    ],
                    'group.name',
                ],
            ]) ?>
        </div>
    </div>


</div>