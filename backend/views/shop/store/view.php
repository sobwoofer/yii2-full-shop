<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:36
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $store core\entities\Shop\Store */

$this->title = $store->name;
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $store->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $store->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Photo</div>
        <div class="box-body">
            <?php if ($store->photo): ?>
                <?= Html::a(Html::img($store->getThumbFileUrl('photo', 'thumb')), $store->getUploadedFileUrl('photo'), [
                    'class' => 'thumbnail',
                    'target' => '_blank'
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $store,
                'attributes' => [
                    'id',
                    'name',
                    'description',
                    'address',
                    'slug',
                    'phone',
                    'email',
                    'work_weekdays',
                    'work_weekend',
                    'city.name'
                ],
            ]) ?>
        </div>
    </div>

</div>

