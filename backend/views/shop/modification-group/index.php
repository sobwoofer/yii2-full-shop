<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 15:48
 */

/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\Shop\ModificationGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use core\entities\Shop\Modification\ModificationGroup;
use yii\grid\ActionColumn;

$this->title = 'Modification Groups';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="modifications">
    <p>
        <?= Html::a('Create modification group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'image',
                        'value' => function (ModificationGroup $model) {
                            return $model->image ? Html::img($model->getThumbFileUrl('image', 'thumb')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (ModificationGroup $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw'
                    ],
                    'slug',
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (ModificationGroup $model) {
                            return \core\helpers\ModificationHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>



</div>
