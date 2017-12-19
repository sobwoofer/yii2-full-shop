<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:03
 */

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use core\helpers\LangsHelper;
use powerkernel\flagiconcss\Flag;
use core\helpers\ProductHelper;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\Product\ProductCreateForm */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-body">
            <div class="box-header with-border">Контент</div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-left ui-sortable-handle">
                    <?php foreach (LangsHelper::getWithSuffix() as $suffix => $lang): ?>
                        <li class="<?= !$suffix ? 'active' : '' ?>">
                            <a href="#langTab-<?= $lang->url ?>" data-toggle="tab" aria-expanded="true">
                                <?= $lang->name ?><?= Flag::widget(['country' => $lang->url]) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content no-padding">
                    <?php foreach (LangsHelper::getWithSuffix() as $suffix => $lang): ?>
                        <div class="chart tab-pane <?= !$suffix ? 'active' : '' ?>" id="langTab-<?= $lang->url ?>">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'title' . $suffix)->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'description' . $suffix)->widget(CKEditor::className()) ?>
                            </div>
                            <!-- //TODO this SEO code need groups in one file with other like files-->
                            <div class="">SEO<?= Flag::widget(['country' => $lang->url]) ?></div>
                            <div class="box-body">
                                <?= $form->field($model->{'meta' . $suffix}, 'title' . $suffix)->textInput() ?>
                                <?= $form->field($model->{'meta' . $suffix}, 'description' . $suffix)->textarea(['rows' => 2]) ?>
                                <?= $form->field($model->{'meta' . $suffix}, 'keywords' . $suffix)->textInput() ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'brandId')->dropDownList($model->brandsList()) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'countryId')->dropDownList($model->countryList(), ['prompt' => '']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'caseCode')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>
                        <?php  if ($model->guide): ?>
                            Guide file was uploaded.
                            <a href="<?= $model->guide ?>">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Download </a>
                        <?php else: ?>
                            Guide file wasn't uploaded
                        <?php endif; ?>
                    </label>
                    <?= $form->field($model, 'guideFile')->fileInput()->label(false) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'qtyInPack')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Warehouses</div>
        <div class="box-body">
            <?php foreach ($model->warehousesProducts as $i => $warehouseModel): ?>
                <div class="box box-warning collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $warehouseModel->getWarehouseName() ?><span class="text-danger">*</span></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']externalStatus')
                                    ->dropDownList(ProductHelper::externalStatusList()) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']extraStatusId')
                                    ->dropDownList($warehouseModel->getExtraStatusList()) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']deliveryTermId')
                                    ->dropDownList($warehouseModel->getDeliveryTermList(), ['prompt' => '']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']price')->textInput()?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']quantity')->textInput()?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']special')->textInput()?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']specialStatus')->dropDownList([1 => 'on', 0 => 'off'])?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']specialStart')
                                    ->label('Special Start (if empty - will be active right now)')
                                    ->widget(DateTimePicker::class, [
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd hh:ii'
                                        ]
                                    ]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($warehouseModel, '[' . $i . ']specialEnd')
                                    ->label('Special End (if empty - will be always active)')
                                    ->widget(DateTimePicker::class, [
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd hh:ii'
                                        ]
                                    ]) ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Categories</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main')->dropDownList($model->categories->categoriesList(), ['prompt' => '']) ?>
                    <?= $form->field($model->categories, 'others')->checkboxList($model->categories->categoriesList()) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Tags</div>
                <div class="box-body">
                    <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                    <?= $form->field($model->tags, 'textNew')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Characteristics</div>
        <div class="box-body">
            <?php foreach ($model->values as $i => $value): ?>
                <?php if ($variants = $value->variantsList()): ?>
                    <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => '']) ?>
                <?php else: ?>
                    <?= $form->field($value, '[' . $i . ']value')->textInput() ?>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Photos</div>
        <div class="box-body">
            <?= $form->field($model->photos, 'files[]')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Photos 360</div>
        <div class="box-body">
            <?= $form->field($model->photos360, 'files[]')->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
