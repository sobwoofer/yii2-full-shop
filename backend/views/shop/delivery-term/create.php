<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:59
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use core\helpers\LangsHelper;
use powerkernel\flagiconcss\Flag;

/** @var string title */
/** @var \core\forms\manage\Shop\DeliveryTermForm $model */

$this->title = 'Create delivery term';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="extra-status-create">

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
            <div class="col-md-4">
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'externalId')->textInput(['maxlength' => true]) ?>
            </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
