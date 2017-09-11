<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 9:10
 */


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\Shop\AddToCartForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Add';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin() ?>

            <?php if ($modifications = $model->modificationsList()): ?>
                <?= $form->field($model, 'modification')->dropDownList($modifications, ['prompt' => '--- Select ---']) ?>
            <?php endif; ?>

            <?= $form->field($model, 'quantity')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Add to Cart', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>

</div>
