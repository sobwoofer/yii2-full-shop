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

use romkaChev\yii2\swiper\Swiper;
use yii\helpers\Html;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <?= $this->render('_subcategories', [
                'category' => $category
            ]) ?>
        </div>
    </div>

    <?= \frontend\widgets\Shop\ViewedProductsWidget::widget(['limit' => 6]) ?>

    <?= \frontend\widgets\Shop\SalesOfWeekProductsWidget::widget(['limit' => 6, 'banner' => [
        'link' => '/',
        'image' => '/images/system/ba2.png'
    ]]) ?>

    <?= $this->render('/shop/seoblock', [
        'shortText' => 'descriptiondescriptiondescription', //TODO var description
    ]) ?>

</div>






