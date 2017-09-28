<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.09.17
 * Time: 16:52
 */
/* @var $role */
/* @var $assignPermissions */
/* @var $assignUsers \core\entities\User\User[] */

use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Role: ' . $role->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $role->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $role->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $role,
                        'attributes' => [
                            'name',
                            'description',
                            'createdAt',
                            'updatedAt',
                            'type'
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permissions</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?= yii\grid\GridView::widget([
                        'dataProvider' => new ArrayDataProvider(['allModels' => $assignPermissions]),
                        'columns' => [
                            'name',
                            'description',
                            'type',
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Users</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?= yii\grid\GridView::widget([
                        'dataProvider' => new ArrayDataProvider(['allModels' => $assignUsers]),
                        'columns' => [
                            'id',
                            'username',
                            'email',
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>