<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 16:35
 */

/* @var $this \yii\web\View */
/* @var $content string */

use romkaChev\yii2\swiper\Swiper;
use yii\helpers\Html;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="main-block">
    <div class="container">
        <div class="col-md-3 col-lg-2">
        </div>
        <div class="col-md-9 col-lg-10 ">
            <div class="row">
                <div class="col-sm-12 col-md-8  left-main-block">
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
                    <div class="row">
                        <div class="">
                            <div class="categories-items">
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-1.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-1-hover.png" alt="">
                                    </div>
                                    <span>Папір офісний</span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-2.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-2-hover.png" alt="">
                                    </div>
                                    <span>РУЧКИ</span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-3.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-3-hover.png" alt="">
                                    </div>
                                    <span>Щоденники </span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-4.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-4-hover.png" alt="">
                                    </div>
                                    <span>Калькулятори </span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-5.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-5-hover.png" alt="">
                                    </div>
                                    <span>Папір для нотаток</span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-6.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-6-hover.png" alt="">
                                    </div>
                                    <span>Папки-реєстратори</span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-7.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-7-hover.png" alt="">
                                    </div>
                                    <span>Блокноти</span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-8.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-8-hover.png" alt="">
                                    </div>
                                    <span>КонвертИ</span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-9.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-9-hover.png" alt="">
                                    </div>
                                    <span>ФайлИ </span>
                                </a>
                                <a href="#" class="categories-item">
                                    <div class="categories-img">
                                        <img src="images/system/categories-10.png" alt="">
                                    </div>
                                    <div class="categories-img-hover">
                                        <img src="images/system/categories-10-hover.png" alt="">
                                    </div>
                                    <span>Бумага КОЛЬОРОВА</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden-md col-md-4 right-block">
                    <div class="responsive-img">
                        <a href="#">
                            <img src="http://static.yii2-shop.dev/dev/b3.png" alt="">
                        </a>
                    </div>
                    <div class="responsive-img">
                        <a href="#">
                            <img src="http://static.yii2-shop.dev/dev/b4.png" alt="">
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<hr>
<div class="product-line product-line-1">
    <div class="container">
        <div class="row">
            <div class="product-line__title__wrp">

                <div class="col-sm-4">
                    <p class="product-line__title">ВЫ СМОТРЕЛИ</p>
                </div>
                <div class="col-md-2">
                    <a href="#" class="read_more">смотреть <span></span></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <?= Swiper::widget( [
            'items'         => [
                $this->render('/shop/_product-item'),
                $this->render('/shop/_product-item'),
                $this->render('/shop/_product-item'),
                $this->render('/shop/_product-item'),
                $this->render('/shop/_product-item'),
            ],
            'behaviours'    => [
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
</div>
<div class="product-line  product-line__tabs">
    <div class="product-line__tabs__wrp">
        <!-- Nav tabs -->
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="col-md-4">
                    <a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                        <div class="product-line__title__wrp">
                            <p class="product-line__title">ПОПУЛЯРНЫЕ</p>
                            <p onclick="document.location.href = '#1'" class="more">смотреть все<span></span></p>
                        </div>
                    </a>
                </li>
                <li role="presentation" class="active col-md-4">
                    <a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
                        <div class="product-line__title__wrp">
                            <p class="product-line__title">НОВИНКИ</p>
                            <p onclick="document.location.href = '#2'" class="more">смотреть все<span></span></p>
                        </div>
                    </a>
                </li>
                <li role="presentation" class="col-md-4">
                    <a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">
                        <div class="product-line__title__wrp">
                            <p class="product-line__title">РАСПРОДАЖИ</p>
                            <p onclick="document.location.href = '#3'" class="more">смотреть все<span></span></p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane " id="tab-1">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="product-line__item">
                                <!-- .stock -->
                                <div class="stock">
                                    <p class="stock__title">Цена
                                        <br>недели</p>
                                    <div class="stock__discount">
                                        -20%
                                    </div>
                                </div>
                                <!-- .stock -->
                                <!-- .product-line__item__logo -->
                                <div class="product-line__item__logo">
                                    <img src="http://static.yii2-shop.dev/dev/product-logo.png" alt="">
                                </div>
                                <!-- .product-line__item__logo -->
                                <!-- .product-line__img -->
                                <div class="product-line__img">
                                    <img src="http://static.yii2-shop.dev/dev/product-img-1.png" alt="">
                                </div>
                                <!-- .product-line__img -->
                                <!-- .product-line__title -->
                                <div class="product-line__title">
                                    <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                                </div>
                                <!-- .product-line__title -->
                                <span class="vendor_code">Артикул: s101003</span>
                                <!-- .price_block -->
                                <div class="price_block price_stock">
                                    <p class="price_old">216.99</p>
                                    <p class="prace_new">215. <span>99</span> грн</p>
                                </div>
                                <!-- .price_block -->
                                <!-- .product-line__item__action-block -->
                                <div class="product-line__item__action-block">
                                    <a href="#" class="like">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </a>
                                    <input type="number" value="1">
                                    <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="star"></div>
                                <!-- .product-line__item__action-block -->
                                <div class="review">
                                    <a href="#" class="pull-right">Оставить отзыв</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="tab-2">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab-3">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                        <div class="swiper-slide">
                            <?=  $this->render('/shop/_product-item') ?>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-line popular">
    <div class="container">
        <div class="row">
            <div class="product-line__title__wrp">

                <div class="col-sm-4">
                    <p class="product-line__title">Популярные</p>
                </div>
                <div class="col-md-2">
                    <a href="#" class="read_more">смотреть <span></span></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<div class="product-line news">
    <div class="container">
        <div class="row">
            <div class="product-line__title__wrp">

                <div class="col-sm-3">
                    <p class="product-line__title">НОВИНКИ</p>
                </div>
                <div class="col-md-2">
                    <a href="#" class="read_more">смотреть <span></span></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>


<div class="product-line sale">
    <div class="container">
        <div class="row">
            <div class="product-line__title__wrp">

                <div class="col-sm-4">
                    <p class="product-line__title">РАСПРОДАЖИ</p>
                </div>
                <div class="col-md-2">
                    <a href="#" class="read_more">смотреть <span></span></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
                <div class="swiper-slide">
                    <?=  $this->render('/shop/_product-item') ?>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<div class="promotions_and_news">
    <div class="container">
        <div class="row">
            <div class="col-md-6 promotions_and_news__block__wrp">
                <a href="#" class="read_more">смотреть все <span></span></a>
                <div class="col-md-7 ">

                    <div class="promotions_and_news__block">
                        <p class="promotions_and_news__block__title">Акции
                        </p>
                        <a href="#">
                            <p>с 04.08.2016 по 23.08.2016</p>
                            <p>Получи подарок ко Дню Независимости Украины</p>
                        </a>
                        <hr>
                        <a href="#">
                            <p>с 04.08.2016 по 23.08.2016</p>
                            <p>Получи подарок ко Дню Независимости Украины</p>
                        </a>
                        <hr>
                        <a href="#">
                            <p>с 04.08.2016 по 23.08.2016</p>
                            <p>Получи подарок ко Дню Независимости Украины</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 promotions_and_news__block__wrp">
                <a href="#" class="read_more">смотреть все <span></span></a>
                <div class="col-md-7 ">

                    <div class="promotions_and_news__block">
                        <p class="promotions_and_news__block__title">Новости</p>
                        <a href="#">
                            <p>с 04.08.2016 по 23.08.2016</p>
                            <p>Получи подарок ко Дню Независимости Украины</p>
                        </a>
                        <hr>
                        <a href="#">
                            <p>с 04.08.2016 по 23.08.2016</p>
                            <p>Получи подарок ко Дню Независимости Украины</p>
                        </a>
                        <hr>
                        <a href="#">
                            <p>с 04.08.2016 по 23.08.2016</p>
                            <p>Получи подарок ко Дню Независимости Украины</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="our_advantages">
    <div class="container">
        <p class="our_advantages__title">Наши преимущества</p>
        <div class="our_advanteges__wrp">
            <div class="our_advantages__item">
                <div class="our_advantages__item__img">
                    <img src="images/system/our_advantages-1.png" alt="">
                </div>
                <p>Собственное
                    <br> производство
                </p>
            </div>
            <div class="our_advantages__item">
                <div class="our_advantages__item__img">
                    <img src="images/system/our_advantages-2.png" alt="">
                </div>
                <p>Собственный
                    <br> автопарк
                </p>
            </div>
            <div class="our_advantages__item">
                <div class="our_advantages__item__img">
                    <img src="images/system/our_advantages-3.png" alt="">
                </div>
                <p>Собственный
                    <br> склад
                </p>
            </div>
            <div class="our_advantages__item">
                <div class="our_advantages__item__img">
                    <img src="images/system/our_advantages-4.png" alt="">
                </div>
                <p>Собственный
                    <br> экспорт
                </p>
            </div>
        </div>
    </div>
</div>
<div class="our_clients">
    <div class="container">
        <p class="our_clients__title">Наши клиенты</p>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-1.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-2.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-3.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-4.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-1.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-2.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-3.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-4.png" alt=""></div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<div class="our_brends">
    <div class="container">
        <p class="our_clients__title">Наши бренды</p>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-1.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-2.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-3.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-4.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-1.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-2.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-3.png" alt=""></div>
                <div class="swiper-slide"><img src="http://static.yii2-shop.dev/dev/client-4.png" alt=""></div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<div class="news">
    <div class="container">
        <div class="news_title_block">
            <p>СТАТЬИ, ОБЗОРЫ НОВИНОК</p>
            <a href="#" class="read_more">смотреть все<span></span></a>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="news__item">
                    <div class="news__item__img">
                        <a href="#"><img src="http://static.yii2-shop.dev/dev/main-news-1.png" alt=""></a>
                    </div>

                    <a href="#" class="news__item__title">ИДЕИ ДЛЯ ДЕЛОВЫХ ПОДАРКОВ</a>
                    <p>Есть очень много способов, помогающих наладить отношения с партнерами, коллегами, руководством, сотрудниками. Один из самых проверенных – преподнесение презентов. Однако при этом не стоит забывать о том, что существует особая культура дарения и выбора.</p>
                    <a href="#" class="read_more"> читать дальше. <span></span></a>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="news__item">
                    <div class="news__item__img">
                        <a href="#"><img src="http://static.yii2-shop.dev/dev/main-news-2.png" alt=""></a>
                    </div>

                    <a href="#" class="news__item__title">ИДЕИ ДЛЯ ДЕЛОВЫХ ПОДАРКОВ</a>
                    <p>Есть очень много способов, помогающих наладить отношения с партнерами, коллегами, руководством, сотрудниками. Один из самых проверенных – преподнесение презентов. Однако при этом не стоит забывать о том, что существует особая культура дарения и выбора.</p>
                    <a href="#" class="read_more"> читать дальше. <span></span></a>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 ">
                <div class="news__item">
                    <div class="news__item__img">
                        <a href="#"><img src="http://static.yii2-shop.dev/dev/main-news-3.png" alt=""></a>
                    </div>

                    <a href="#" class="news__item__title">ИДЕИ ДЛЯ ДЕЛОВЫХ ПОДАРКОВ</a>
                    <p>Есть очень много способов, помогающих наладить отношения с партнерами, коллегами, руководством, сотрудниками. Один из самых проверенных – преподнесение презентов. Однако при этом не стоит забывать о том, что существует особая культура дарения и выбора.</p>
                    <a href="#" class="read_more"> читать дальше. <span></span></a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 hidden visible-lg">
                <div class="news__item">
                    <div class="news__item__img">
                        <a href="#"><img src="http://static.yii2-shop.dev/dev/main-news-3.png" alt=""></a>
                    </div>

                    <a href="#" class="news__item__title">ИДЕИ ДЛЯ ДЕЛОВЫХ ПОДАРКОВ</a>
                    <p>Есть очень много способов, помогающих наладить отношения с партнерами, коллегами, руководством, сотрудниками. Один из самых проверенных – преподнесение презентов. Однако при этом не стоит забывать о том, что существует особая культура дарения и выбора.</p>
                    <a href="#" class="read_more"> читать дальше. <span></span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>
<div class="seo-text-block">
    <div class="container">

        <div class="min-seo-text">
            <p>
                Для обеспечения бесперебойной работы офиса необходим самый широкий ассортимент канцелярских товаров. На сайте интернет магазина "Папирус" можно подобрать канцтовары на любой вкус: офисная бумага, ручки, дыроколы, офисные стулья и многое другое. Интернет магазин канцтоваров предлагает вашему вниманию более 15 000 наименований основного товара.
            </p>

        </div>
        <div class="max-seo-text" style="display: none;">
            <p>
                Для обеспечения бесперебойной работы офиса необходим самый широкий ассортимент канцелярских товаров. На сайте интернет магазина "Папирус" можно подобрать канцтовары на любой вкус: офисная бумага, ручки, дыроколы, офисные стулья и многое другое. Интернет магазин канцтоваров предлагает вашему вниманию более 15 000 наименований основного товара.
                Для обеспечения бесперебойной работы офиса необходим самый широкий ассортимент канцелярских товаров. На сайте интернет магазина "Папирус" можно подобрать канцтовары на любой вкус: офисная бумага, ручки, дыроколы, офисные стулья и многое другое. Интернет магазин канцтоваров предлагает вашему вниманию более 15 000 наименований основного товара.
                Для обеспечения бесперебойной работы офиса необходим самый широкий ассортимент канцелярских товаров. На сайте интернет магазина "Папирус" можно подобрать канцтовары на любой вкус: офисная бумага, ручки, дыроколы, офисные стулья и многое другое. Интернет магазин канцтоваров предлагает вашему вниманию более 15 000 наименований основного товара.
                Для обеспечения бесперебойной работы офиса необходим самый широкий ассортимент канцелярских товаров. На сайте интернет магазина "Папирус" можно подобрать канцтовары на любой вкус: офисная бумага, ручки, дыроколы, офисные стулья и многое другое. Интернет магазин канцтоваров предлагает вашему вниманию более 15 000 наименований основного товара.
                Для обеспечения бесперебойной работы офиса необходим самый широкий ассортимент канцелярских товаров. На сайте интернет магазина "Папирус" можно подобрать канцтовары на любой вкус: офисная бумага, ручки, дыроколы, офисные стулья и многое другое. Интернет магазин канцтоваров предлагает вашему вниманию более 15 000 наименований основного товара.
            </p>
        </div>

        <p class="text-right"><a href="#/" class="read_more"> читать дальше. <span></span></a></p>
    </div>
</div>

<?php $this->endContent() ?>
