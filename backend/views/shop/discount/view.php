<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:36
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use core\entities\Shop\Discount;

/* @var $this yii\web\View */
/* @var $discount core\entities\Shop\Discount */

$this->title = $discount->name;
$this->params['breadcrumbs'][] = ['label' => 'Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $discount->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $discount->id], [
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
                'model' => $discount,
                'attributes' => [
                    'id',
                    'name',
                    'description',
                    'percent',
                    'sort',
                    [
                        'attribute' => 'from date',
                        'value' => function (Discount $model) {
                            return $model->from_date;
                        },
                        'format' => 'datetime'
                    ],
                    [
                        'attribute' => 'to date',
                        'value' => function (Discount $model) {
                            return $model->to_date;
                        },
                        'format' => 'datetime'
                    ],
                    'active',
                ],
            ]) ?>
        </div>
    </div>

</div>

