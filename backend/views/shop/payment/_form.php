<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:11
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\helpers\LangsHelper;
use powerkernel\flagiconcss\Flag;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\PaymentMethod\PaymentMethodForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="method-form">

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
                                <?= $form->field($model, 'description' . $suffix)->textarea(['rows' => 6]) ?>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'minCost')->textInput() ?>
            <?= $form->field($model, 'maxCost')->textInput() ?>
            <?= $form->field($model, 'active')->dropDownList([1,0]) ?>
            <?= $form->field($model, 'warehouseId')->dropDownList($model->getWarehouseList(), ['prompt' => 'all']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Depend on Deliveries (Visibility depend on select delivery)</div>
                <div class="box-body">
                    <?= $form->field($model->delivery, 'deliveries')->checkboxList($model->delivery->deliveryList(), ['prompt' => '']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
