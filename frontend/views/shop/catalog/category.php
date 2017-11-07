<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 9:16
 */


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category core\entities\Shop\Category */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $category->name;
$this->params['active_category'] = $category;
?>

<?php
//var_dump($dataProvider->getModels());
?>

<div class="container">
    <div class="col-md-9 pull-right">
        <div class="hidden-sm hidden-xs">
            <div class="bread_crumbs">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => '']
                ]) ?>
            </div>
        </div>
    </div>
    <?php if ($category->children || empty($dataProvider->getModels())): ?>
        <div class="row clearfix">
            <div class="col-md-3 ">
            </div>
            <div class="col-md-9 ">
                <div class="row">
                    <div class="col-sm-12 left-main-block">
                        <?= \frontend\widgets\content\SliderForBannersWidget::widget() ?>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="main-block">-->
<!--            <div class="container">-->
<!---->
<!--            </div>-->
<!--        </div>-->

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">

                <?= $this->render('_subcategories', [
                    'category' => $category
                ]) ?>

            </div>
        </div>

        <hr>
    <?php endif; ?>



    <?php if (!$category->children && !empty($dataProvider->getModels())): ?>
            <div class="row">
                <div class="catalog-page">
                    <div class="wrpper_filterToggler  hidden-sm hidden-md hidden-lg">
                        <h2 class="catalog-title"><b>Шариковые ручки</b></h2>
                        <button id="showFilter" class="btn btn_blue btn_show_filter">Показать фильтр</button>
                    </div>
                    <?=  $this->render('/shop/filter') ?>

                    <?= $this->render('_list', [
                        'dataProvider' => $dataProvider
                    ]) ?>

                </div>
            </div>
        <div class="clearfix"></div>
        <?= \frontend\widgets\Shop\ViewedProductsWidget::widget() ?>
    <?php endif; ?>

</div>

<?= \frontend\widgets\Shop\SalesOfWeekProductsWidget::widget() ?>

<?= $this->render('/shop/seoblock', [
    'shortText' => $category->description
    ]) ?>



