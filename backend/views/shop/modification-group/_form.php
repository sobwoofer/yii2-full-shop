<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:01
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\helpers\LangsHelper;
use powerkernel\flagiconcss\Flag;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\Modification\ModificationGroupForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modification-form">

    <?php $form = ActiveForm::begin(); ?>

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
                                <?= $form->field($model, 'description' . $suffix)->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Image</div>
        <div class="box-body">
            <?= $form->field($model, 'image')->label(false)->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                ]
            ]) ?>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">General</div>
        <div class="box-body">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->dropDownList(\core\helpers\ModificationGroupHelper::statusList()) ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
