<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 11:55
 */
use yii\helpers\Html;
use yii\grid\GridView;
use core\entities\Shop\GivePoint;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\shop\GivePointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Give point';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">
    <p>
        <?= Html::a('Create give point', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (GivePoint $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw'
                    ],
                    'slug',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>

</div>
