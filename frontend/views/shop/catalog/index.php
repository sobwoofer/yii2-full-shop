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

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-block">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-2">
            </div>
            <div class="col-md-9 col-lg-10">
                <div class="row">
                    <div class="col-sm-12 col-lg-8 left-main-block">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="images/categories-slider-img.png" alt=""></div>
                                <div class="swiper-slide"><img src="images/categories-slider-img.png" alt=""></div>
                                <div class="swiper-slide"><img src="images/categories-slider-img.png" alt=""></div>
                                <div class="swiper-slide"><img src="images/categories-slider-img.png" alt=""></div>
                                <div class="swiper-slide"><img src="images/categories-slider-img.png" alt=""></div>
                                <div class="swiper-slide"><img src="images/categories-slider-img.png" alt=""></div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                    <div class="hidden-md col-lg-4 right-block">
                        <div class="responsive-img">
                            <a href="#">
                                <img src="images/b2.png" alt="" style="max-height: 401px;">
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="container">

    <?= $this->render('_subcategories', [
        'category' => $category
    ]) ?>

    //= modules/product-line.html <!-- //TODO widget product-line -->

    <?= $this->render('/shop/seoblock', [
        'shortText' => 'descriptiondescriptiondescription', //TODO var description
    ]) ?>

    <?= $this->render('_list', [
        'dataProvider' => $dataProvider
    ]) ?>

</div>






