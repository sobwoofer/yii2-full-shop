<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.09.17
 * Time: 13:11
 */

/* @var yii\rbac\Role $roles[]  */
/* @var $permissions array */
/* @var $searchModel backend\forms\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\ActionColumn;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Roles</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?= yii\grid\GridView::widget([
                'dataProvider' => new ArrayDataProvider(['allModels' => $roles]),
                'columns' => [
                    'name',
                    'description',
                    'type',
                    ['class' => ActionColumn::class,  'template' => '{view} {delete}']
                ]
            ]); ?>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Create role or Permission</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= Html::beginForm('create', 'post', ['class' => 'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                    <?= Html::textInput('name', '', ['class' => 'form-control']); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

                <div class="col-sm-10">
                    <?= Html::textInput('description', '', ['class' => 'form-control']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::dropDownList('userId', 1,
                        ['1' => 'role', '2' => 'permission'],
                        ['class' => 'form-control']); ?>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <?= Html::submitButton('Add role', ['class' => 'btn btn-info pull-right']) ?>
        </div>
        <!-- /.box-footer -->
        <?= Html::endForm(); ?>
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
                    ['class' => ActionColumn::class]
                ]
            ]); ?>
        </div>
    </div>
</div>


