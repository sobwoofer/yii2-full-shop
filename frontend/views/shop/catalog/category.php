<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 9:16
 */
/* @var $this yii\web\View */

/* @var $category core\entities\Shop\Category */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="container">
    <div class="row">
        <div class="catalog-page">
            <?=  $this->render('/shop/filter') ?>
            <div class="content">
                <div class="col-sm-9 col-lg-10">
                    <div class="bread_crumbs">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => '']
                        ]) ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-6"><h2 class="catalog-title"><b>Шариковые ручки</b></h2></div>
                        <div class="col-sm-6">

                            <div class="display-wrp pull-right">
                                <!--<p>Отображение</p>-->
                                <a href="/catalog.html" class="grid"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                <a href="/catalog_list.html" class="list"><i class="fa fa-list" aria-hidden="true"></i></a>
                            </div>
                            <div class="select">
                                <select class="pull-right ">
                                    <option value="#">по рейтингу</option>
                                    <option value="#">по рейтингу </option>
                                    <option value="#">по рейтингу</option>
                                    <option value="#">по рейтингу</option>
                                    <option value="#">по рейтингу</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="product_content">
                        <?php foreach ($dataProvider->getModels() as $product): ?>
                            <div class="col-sm-4 col-lg-3">
                                <?=  $this->render('/shop/catalog/_product',[
                                    'product' => $product
                                ]) ?>
                            </div>
                        <?php endforeach; ?>

                        <div class="load-more">
                            <img src="http://static.yii-shop.dev/dev/load-more.png" alt="">
                            <p>Загрузить еще <br>15 товаров</p>
                        </div>

                        <?= LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                        ]) ?>
                        <div class="col-sm-6 text-right">Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></div>
                        <div class="paginator">
                            <ul>
                                <li><a href="#">Пред.</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">След.</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="clearfix"></div>


//= modules/product-line.html

//= modules/seo-block.html


//= modules/product-line.html

//= modules/seo-block.html
