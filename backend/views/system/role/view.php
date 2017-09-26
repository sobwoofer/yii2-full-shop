<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.09.17
 * Time: 16:52
 */
/* @var $role */
/* @var $permissions */
/* @var $users \core\entities\User\User[] */
/* @var $assignUsers \core\entities\User\User[] */

use yii\widgets\DetailView;
use yii\data\ArrayDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Role: ' . $role->name;
$this->params['breadcrumbs'][] = $this->title;
?>
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
                    'dataProvider' => new ArrayDataProvider(['allModels' => $permissions]),
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
                        [
                            'class' => ActionColumn::class,
                            'template' =>  '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model, $index) {
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-trash"></span>',
                                        '/system/role/revoke?'. http_build_query([
                                            'userId' => $model->id,
                                            'roleName' => $this->context->actionParams['id']]), []
                                    );
                                },
                            ],
                        ],
                    ]
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Assign user to Role</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= Html::beginForm('assign', 'post', ['class' => 'form-horizontal']) ?>
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Role name</label>

                    <div class="col-sm-10">
                        <?= Html::textInput('name', '', ['class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?= Html::dropDownList('userId', null,
                            ArrayHelper::map($assignUsers, 'id', 'username'),
                            ['class' => 'form-control']); ?>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

                <?= Html::submitButton('Assign user', ['class' => 'btn btn-info pull-right']) ?>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>