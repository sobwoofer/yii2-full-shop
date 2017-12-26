<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 16:39
 */

/* @var $this yii\web\View */
/* @var $modificationGroup \core\entities\Shop\Modification\ModificationGroup */

use yii\helpers\Html;
use yii\widgets\DetailView;

//$this->title = $modification->name;
$this->title = 'View Modification';
$this->params['breadcrumbs'][] = ['label' => 'Modification Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="modification-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $modificationGroup->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $modificationGroup->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Image</div>
        <div class="box-body">
            <?php if ($modificationGroup->image): ?>
                <?= Html::a(Html::img($modificationGroup->getThumbFileUrl('image', 'thumb')), $modificationGroup->getUploadedFileUrl('image'), [
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
                'model' => $modificationGroup,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    [
                        'attribute' => 'status',
                        'value' => \core\helpers\ModificationGroupHelper::statusLabel($modificationGroup->status),
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
        </div>
    </div>


</div>