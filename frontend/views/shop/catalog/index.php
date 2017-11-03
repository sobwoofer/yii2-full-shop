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

<div class="main-block">

    <div class="container">
        <div class="row">

            <div class="col-md-3 ">
            </div>
            <div class="col-md-9 ">
                <div class="row">
                    <div class="col-sm-12  left-main-block">
                        <?= Swiper::widget( [
                            'items'         => [
                                Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
                                Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
                                Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
                                Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
                                Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png'),
                                Html::img('http://static.yii2-shop.dev/dev/main-slider-img.png')
                            ],
                            'behaviours'    => [
                                'pagination',
                                'nextButton',
                                'prevButton'
                            ],
                            'pluginOptions' => [
                                'grabCursor'     => true,
                                'centeredSlides' => true,
                                'slidesPerView'  => 'auto',
                                'effect'         => 'coverflow',
                                'coverflow'      => [
                                    'rotate'       => 50,
                                    'stretch'      => 0,
                                    'depth'        => 100,
                                    'modifier'     => 1,
                                    'slideShadows' => true
                                ]
                            ]
                        ] ); ?>
                    </div>
                    <!--<div class="hidden-md col-lg-4 right-block">-->
                    <!--<div class="responsive-img">-->
                    <!--<a href="#">-->
                    <!--<img src="images/b2.png" alt="" style="max-height: 401px;">-->
                    <!--</a>-->
                    <!--</div>-->

                    <!--</div>-->
                </div>

            </div>
        </div>
    </div>

</div>


<div class="container">

    <?= $this->render('_subcategories', [
        'category' => $category
    ]) ?>

    <?= \frontend\widgets\Shop\ViewedProductsWidget::widget(['limit' => 6]) ?>

    <?= \frontend\widgets\Shop\SalesOfWeekProductsWidget::widget(['limit' => 6, 'banner' => [
        'link' => '/',
        'image' => '/images/system/ba2.png'
    ]]) ?>

    <?= $this->render('/shop/seoblock', [
        'shortText' => 'descriptiondescriptiondescription', //TODO var description
    ]) ?>

</div>






