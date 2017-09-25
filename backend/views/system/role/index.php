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

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Roles</h3>
        </div>
        <!-- /.box-header -->
        <?php var_dump($roles); ?>
        <div class="box-body">
            <?= yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $roles,
                ])
            ]); ?>
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
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $permissions])
            ]); ?>
        </div>
    </div>
</div>


