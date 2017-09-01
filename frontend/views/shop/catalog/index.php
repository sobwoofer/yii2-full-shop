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

    <div class="row">
        <div class="col-md-3 col-lg-2"></div>
        <div class="col-md-9 col-lg-10">
            <div class="categories">
                <?php foreach ($category->children as $child): ?>
                    <div class="col-sm-4 col-lg-2">
                        <div class="categories-item">
                            <div class="categories-item-img">
                                <a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>">
                                    <img src="images/paper.png" alt="">
                                </a>
                            </div>
                            <span><?= Html::encode($child->name) ?></span>
                            <ul>
                                <li><a href="#">все товары</a></li>
                            </ul>
                            <span>Конверты</span>
                            <ul>
                                <li><a href="#">все товары</a></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>

    <hr>
</div>
    //= modules/product-line.html

    //= modules/seo-block.html

