<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 11:55
 */
use yii\helpers\Html;
use yii\grid\GridView;
use core\entities\Shop\Store;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\shop\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">
    <p>
        <?= Html::a('Create store', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'value' => function (Store $model) {
                            return $model->photo ? Html::img($model->getThumbFileUrl('photo', 'admin')) : null;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Store $model) {
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
