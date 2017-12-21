<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:05
 */

use kartik\file\FileInput;
use core\entities\Shop\Product\Modification;
use core\entities\Shop\Product\Value;
use core\helpers\PriceHelper;
use core\helpers\ProductHelper;
use yii\bootstrap\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use core\entities\Shop\Product\Product;
use yii\widgets\DetailView;
use core\entities\Shop\Product\WarehousesProduct;
use core\entities\Shop\Product\RelatedAssignment;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $photosForm core\forms\manage\Shop\Product\PhotosForm */
/* @var $photos360Form core\forms\manage\Shop\Product\Photos360Form */
/* @var $relatedForm core\forms\manage\Shop\Product\RelatedForm */
/* @var $buyWithForm core\forms\manage\Shop\Product\BuyWithForm */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php if ($product->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'id' => $product->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'id' => $product->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Common</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'status',
                                'value' => ProductHelper::statusLabel($product->status),
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'guide',
                                'value' => $product->guide ? Html::a('download', Yii::getAlias('@static/guides/' . $product->guide)):'',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'brand_id',
                                'value' => ArrayHelper::getValue($product, 'brand.name'),
                            ],
                            [
                                'attribute' => 'country_id',
                                'value' => ArrayHelper::getValue($product, 'country.name'),
                            ],
                            'case_code',
                            'qty_in_pack',
                            [
                                'attribute' => 'video',
                                'value' => $product->video ? Html::a($product->video, $product->video):'',
                                'format' => 'raw',
                            ],
                            'code',
                            'name',
                            [
                                'attribute' => 'category_id',
                                'value' => ArrayHelper::getValue($product, 'category.name'),
                            ],
                            [
                                'label' => 'Other categories',
                                'value' => implode(', ', ArrayHelper::getColumn($product->categories, 'name')),
                            ],
                            [
                                'label' => 'Tags',
                                'value' => implode(', ', ArrayHelper::getColumn($product->tags, 'name')),
                            ],
                            [
                                'attribute' => 'weight',
                                'value' => $product->weight / 1000 . ' kg',
                            ],
                            [
                                'attribute' => 'default warehouse price',
                                'value' => function (Product $model) {
                                    return PriceHelper::format($model->warehousesProduct->price);
                                },
                            ],
                        ],
                    ]) ?>
                    <br />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php foreach ($product->warehousesProducts as $warehousesProduct): ?>
                <div class="box box-default">
                    <div class="box-header with-border"><?= $warehousesProduct->warehouse->name ?></div>
                    <div class="box-body">

                        <?= DetailView::widget([
                            'model' => $warehousesProduct,
                            'attributes' => [
                                [
                                    'attribute' => 'price',
                                    'value' => function (WarehousesProduct $model) {
                                        return PriceHelper::format($model->price);
                                    },
                                ],
                                'special_status',
                                [
                                    'attribute' => 'special',
                                    'value' => function (WarehousesProduct $model) {
                                        return PriceHelper::format($model->special);
                                    },
                                ],
                                [
                                    'attribute' => 'special start',
                                    'value' => function (WarehousesProduct $model) {
                                        return $model->special_start;
                                    },
                                    'format' => 'datetime'
                                ],
                                [
                                    'attribute' => 'special end',
                                    'value' => function (WarehousesProduct $model) {
                                        return $model->special_end;
                                    },
                                    'format' => 'datetime'
                                ],
                                [
                                    'attribute' => 'external status',
                                    'value' => function (WarehousesProduct $model) {
                                        return ProductHelper::externalStatusLabel($model->external_status);
                                    },
                                    'format' => 'raw'
                                ],
                                [
                                    'attribute' => 'extra status',
                                    'value' => function (WarehousesProduct $model) {
                                        return $model->extraStatus->name;
                                    },
                                    'format' => 'raw'
                                ],
                                [
                                    'attribute' => 'delivery term',
                                    'value' => function (WarehousesProduct $model) {
                                        return $model->deliveryTerm->name ?? null;
                                    },
                                    'format' => 'raw'
                                ],
                                'quantity'
                            ],
                        ]) ?>
                    </div>
                </div>
            <?php endforeach;   ?>

        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Characteristics</div>
                <div class="box-body">

                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => array_map(function (Value $value) {
                            return [
                                'label' => $value->characteristic->name,
                                'value' => $value->value,
                            ];
                        }, $product->values),
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default" id="relatedProducts">
                <div class="box-header with-border">Related Products</div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>id</td>
                            <td>name</td>
                            <td>delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($product->relatedAssignments as $relatedAssignment): ?>
                            <tr>
                                <td><?= $relatedAssignment->relatedProduct->id ?></td>
                                <td><?= $relatedAssignment->relatedProduct->name ?></td>
                                <td>
                                    <a href="<?= Url::to([
                                        '/shop/product/delete-related',
                                        'id' => $product->id,
                                        'otherId' => $relatedAssignment->relatedProduct->id
                                    ]) ?>" class="text-danger">
                                        <i class="fa fa-remove"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php $form = ActiveForm::begin(['action' => '/shop/product/add-related?id=' . $product->id]) ?>
                        <div class="col-sm-8"> <?= $form->field($relatedForm, 'relatedId') ?></div>

                        <div class="col-sm-4">
                            <div class="btn-group" style="padding-top:25px">
                                <?= Html::submitButton('add', ['class' => 'btn btn-success']) ?>
                            </div>

                        </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <div class="box box-default" id="buyWithProducts">
                <div class="box-header with-border">Buy With Products</div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>id</td>
                            <td>name</td>
                            <td>delete</td>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($product->buyWithAssignments as $buyWithAssignment): ?>
                            <tr>
                                <td><?= $buyWithAssignment->buyWithProduct->id ?></td>
                                <td><?= $buyWithAssignment->buyWithProduct->name ?></td>
                                <td>
                                    <a href="<?= Url::to([
                                        '/shop/product/delete-buy-with',
                                        'id' => $product->id,
                                        'otherId' => $buyWithAssignment->buyWithProduct->id
                                    ]) ?>" class="text-danger">
                                        <i class="fa fa-remove"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php $form = ActiveForm::begin(['action' => '/shop/product/add-buy-with?id=' . $product->id]) ?>
                    <div class="col-sm-8"> <?= $form->field($buyWithForm, 'relatedId') ?></div>

                    <div class="col-sm-4">
                        <div class="btn-group" style="padding-top:25px">
                            <?= Html::submitButton('add', ['class' => 'btn btn-success']) ?>
                        </div>

                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">Description</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($product->description, [
                'Attr.AllowedRel' => array('nofollow'),
                'HTML.SafeObject' => true,
                'Output.FlashCompat' => true,
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
            ]) ?>
        </div>
    </div>

    <div class="box" id="modifications">
        <div class="box-header with-border">Modifications</div>
        <div class="box-body">
            <p>
                <?= Html::a('Add Modification', ['shop/modification/create', 'product_id' => $product->id], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $modificationsProvider,
                'columns' => [
                    'code',
                    'name',
                    [
                        'attribute' => 'price',
                        'value' => function (Modification $model) {
                            return PriceHelper::format($model->price);
                        },
                    ],
                    'quantity',
                    [
                        'class' => ActionColumn::class,
                        'controller' => 'shop/modification',
                        'template' => '{update} {delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    [
                        'attribute' => 'meta.title',
                        'value' => $product->translation->meta->title,
                    ],
                    [
                        'attribute' => 'meta.description',
                        'value' => $product->translation->meta->description,
                    ],
                    [
                        'attribute' => 'meta.keywords',
                        'value' => $product->translation->meta->keywords,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box" id="photos">
        <div class="box-header with-border">Photos</div>
        <div class="box-body">

            <div class="row">
                <?php foreach ($product->photos as $photo): ?>
                    <div class="col-md-2 col-xs-3" style="text-align: center">
                        <div class="btn-group">
                            <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-up', 'id' => $product->id, 'photo_id' => $photo->id], [
                                'class' => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo', 'id' => $product->id, 'photo_id' => $photo->id], [
                                'class' => 'btn btn-default',
                                'data-method' => 'post',
                                'data-confirm' => 'Remove photo?',
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-down', 'id' => $product->id, 'photo_id' => $photo->id], [
                                'class' => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                        </div>
                        <div>
                            <?= Html::a(
                                Html::img($photo->getThumbFileUrl('file', 'thumb')),
                                $photo->getUploadedFileUrl('file'),
                                ['class' => 'thumbnail', 'target' => '_blank']
                            ) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php $form = ActiveForm::begin([
                'action' => '/shop/product/add-photos?id=' . $product->id,
                'options' => ['enctype'=>'multipart/form-data'],
            ]); ?>

            <?= $form->field($photosForm, 'files[]')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <div class="box" id="photos360">
        <div class="box-header with-border">Photos 360</div>
        <div class="box-body">

            <div class="row">
                <?php
//                var_dump($product->photos360);

                ?>
                <?php foreach ($product->photos360 as $photo): ?>
                    <div class="col-md-2 col-xs-3" style="text-align: center">
                        <div class="btn-group">
                            <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-360-up', 'id' => $product->id, 'photo_id' => $photo->id], [
                                'class' => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo-360', 'id' => $product->id, 'photo_id' => $photo->id], [
                                'class' => 'btn btn-default',
                                'data-method' => 'post',
                                'data-confirm' => 'Remove photo?',
                            ]); ?>
                            <?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-360-down', 'id' => $product->id, 'photo_id' => $photo->id], [
                                'class' => 'btn btn-default',
                                'data-method' => 'post',
                            ]); ?>
                        </div>
                        <div>
                            <?= Html::a(
                                Html::img($photo->getThumbFileUrl('file', 'thumb')),
                                $photo->getUploadedFileUrl('file'),
                                ['class' => 'thumbnail', 'target' => '_blank']
                            ) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php $form = ActiveForm::begin([
                'action' => '/shop/product/add-photos-360?id=' . $product->id,
                'options' => ['enctype'=>'multipart/form-data'],
            ]); ?>

            <?= $form->field($photos360Form, 'files[]')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
