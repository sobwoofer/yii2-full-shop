<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.09.17
 * Time: 12:18
 */


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $searchForm \core\forms\Shop\Search\SearchForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Search';

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
<div class="row">

    <div class="catalog-page">

        <div class="col-sm-3 col-lg-2">
            <div class="left-nav-block">
                <p class="left-serch-title text-center">Найдено 123 товара</p>
                <ul>
                    <li><a href="#">Личные данные <span>(50)</span></a></li>
                    <li><a href="#">Избранное <span>(50)</span></a></li>
                    <li><a href="#">История заказов <span>(50)</span></a></li>
                    <li><a href="#">Отзывы <span>(50)</span></a></li>
                    <li><a href="#">Персональное предложение <span>(50)</span></a></li>
                    <li><a href="#">Просмотренные <span>(50)</span></a></li>
                </ul>
            </div>
            <div class="responsive-img">
                <img src="images/b.png" alt="">
            </div>
        </div>
        <?= $this->render('_list', [
            'dataProvider' => $dataProvider
        ]) ?>
    </div>
</div>

</div>

<div class="clearfix"></div>




<!-- TODO maybe delete this code of detail filter because there is not was in design -->
<div class="panel panel-default">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get']) ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($searchForm, 'text')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchForm, 'category')->dropDownList($searchForm->categoriesList(), ['prompt' => '']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchForm, 'brand')->dropDownList($searchForm->brandsList(), ['prompt' => '']) ?>
            </div>
        </div>

        <?php foreach ($searchForm->values as $i => $value): ?>
            <div class="row">
                <div class="col-md-4">
                    <?= Html::encode($value->getCharacteristicName()) ?>
                </div>
                <?php if ($variants = $value->variantsList()): ?>
                    <div class="col-md-4">
                        <?= $form->field($value, '[' . $i . ']equal')->dropDownList($variants, ['prompt' => '']) ?>
                    </div>
                <?php elseif ($value->isAttributeSafe('from') && $value->isAttributeSafe('to')): ?>
                    <div class="col-md-2">
                        <?= $form->field($value, '[' . $i . ']from')->textInput() ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($value, '[' . $i . ']to')->textInput() ?>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>

        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>
            <div class="col-md-6">
                <?= Html::a('Clear', [''], ['class' => 'btn btn-default btn-lg btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>




