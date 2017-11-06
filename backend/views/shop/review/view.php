<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.11.17
 * Time: 12:58
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $product \core\entities\Shop\Product\Product */
/* @var $review \core\entities\Shop\Product\Review */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'product_id' => $product->id, 'id' => $review->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($review->isActive()): ?>
            <?= Html::a('Delete', ['delete', 'product_id' => $product->id, 'id' => $review->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Restore', ['activate', 'product_id' => $product->id, 'id' => $review->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to activate this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $review,
                'attributes' => [
                    'id',
                    'created_at:boolean',
                    'active:boolean',
                    'user_id',
                    'parent_id',
                    [
                        'attribute' => 'product_id',
                        'value' => $product->name,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($review->text) ?>
        </div>
    </div>

</div>
