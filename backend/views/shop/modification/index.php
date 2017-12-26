<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 15:48
 */

/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\Shop\ModificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use core\entities\Shop\Modification\Modification;
use yii\grid\ActionColumn;

$this->title = 'Modifications';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="modifications">
    <p>
        <?= Html::a('Create modification', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'value' => function (Modification $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'group_id',
                        'filter' => $searchModel->groupList(),
                        'value' => 'group.name',
                    ],
                    ['class' => ActionColumn::class],
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Modification $model) {
                            return \core\helpers\ModificationHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
