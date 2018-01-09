<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use core\helpers\LangsHelper;
use powerkernel\flagiconcss\Flag;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\DiscountForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($model, 'percent')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'fromDate')
                ->label('fromDate (if empty - will be active right now)')
                ->widget(DateTimePicker::class, [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii'
                    ]
                ]) ?>
            <?= $form->field($model, 'toDate')
                ->label('toDate (if empty - will be active right now)')
                ->widget(DateTimePicker::class, [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii'
                    ]
                ]) ?>
            <?= $form->field($model, 'active')->dropDownList([0, 1]) ?>
            <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
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
