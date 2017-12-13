<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use core\helpers\LangsHelper;
use powerkernel\flagiconcss\Flag;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\StoreForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <div class="col-md-4">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'cityId')->dropDownList($model->cityList()) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'photo')->widget(FileInput::class, [
                    'options' => [
                        'accept' => 'image/*',
                    ]
                ]) ?>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Address</div>
        <div class="box-body">
            <div class="col-md-4">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'workWeekdays')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'workWeekend')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

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
                                <?= $form->field($model, 'address' . $suffix)->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'description' . $suffix)->textarea(['rows' => 5]) ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
