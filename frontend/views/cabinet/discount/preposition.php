<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 27.10.17
 * Time: 16:51
 */

$this->title = 'Preposition';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/index']];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\Breadcrumbs;

?>

<div class="catalog-page">
    <div class="hidden-sm hidden-xs">
        <div class="bread_crumbs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => '']
            ]) ?>
        </div>
    </div>

        <div class="row">
            <div class="col-sm-6"><h2 class="catalog-title"><b>Персональное предложение</b></h2></div>
            <div class="col-sm-6">

                <div class="display-wrp pull-right">
                    <a href="/catalog.html" class="grid"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                    <a href="/catalog_list.html" class="list"><i class="fa fa-list" aria-hidden="true"></i></a>
                </div>
                <div class="select">

                    <select class="pull-right">
                        <option value="#">1</option>
                        <option value="#">2</option>
                        <option value="#">3</option>
                        <option value="#">4</option>
                        <option value="#">5</option>
                    </select>

                </div>
                <div class="hidden visible-xs">

                    <div class="clearfix"></div>
                    <br>
                </div>

            </div>
        </div>


        <div class="timer_wrp">
            <p class="timer-title pull-left">
                До окончания <br>
                предложения осталось
            </p>

            <div id="clock" class="timer"></div>
            <div class="clearfix"></div>

        </div>

        <script type="text/template" id="clock-template">
            <div class="time <%= label %>">
                <span class="count curr top"><%= curr %></span>
                <span class="count next top"><%= next %></span>
                <span class="count next bottom"><%= next %></span>
                <span class="count curr bottom"><%= curr %></span>
                <span class="label"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
            </div>
        </script>


        <br>
        <br>

        <div class="product_content">
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block  price_stock">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 ">
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
                        <img src="images/product-logo.png" alt="">
                    </div>
                    <!-- .product-line__item__logo -->
                    <!-- .product-line__img -->
                    <div class="product-line__img">
                        <img src="images/product-img-1.png" alt="">
                    </div>
                    <!-- .product-line__img -->
                    <!-- .product-line__title -->
                    <div class="product-line__title">
                        <p>Папка-конверт А4 непрозрачная на кнопке, фактура апельсин</p>
                    </div>
                    <!-- .product-line__title -->
                    <span class="vendor_code">Артикул: s101003</span>
                    <!-- .price_block price_stock price_stock -->
                    <div class="price_block price_stock ">
                        <p class="price_old">216.99</p>
                        <p class="prace_new">215. <span>99</span> грн</p>
                    </div>
                    <!-- .price_block price_stock price_stock -->
                    <!-- .product-line__item__action-block -->
                    <div class="product-line__item__action-block">
                        <a href="#" class="like">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </a>
                        <input type="number" value="1">
                        <a href="#" class="btn btn-to-cart">В КОРЗИНУ</a>
                    </div>
                    <!-- .product-line__item__action-block -->
                    <div class="star"></div>
                    <div class="review">
                        <a href="#" class="pull-right">Оставить отзыв</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hover-block">
                        <p class="color-wrp-title">Цвет</p>
                        <div class="color-wrp">
                            <input type="radio" name="color" id="red" value="red"/>
                            <label for="red"><span class="red"></span></label>
                            <input type="radio" name="color" id="green"/>
                            <label for="green"><span class="green"></span></label>
                            <input type="radio" name="color" id="yellow"/>
                            <label for="yellow"><span class="yellow"></span></label>
                            <input type="radio" name="color" id="olive"/>
                            <label for="olive"><span class="olive"></span></label>
                            <input type="radio" name="color" id="orange"/>
                            <label for="orange"><span class="orange"></span></label>
                            <input type="radio" name="color" id="teal"/>
                            <label for="teal"><span class="teal"></span></label>
                            <input type="radio" name="color" id="blue"/>
                            <label for="blue"><span class="teal"></span></label>
                            <input type="radio" name="color" id="violet"/>
                            <label for="violet"><span class="violet"></span></label>
                            <input type="radio" name="color" id="purple"/>
                            <label for="purple"><span class="purple"></span></label>
                            <input type="radio" name="color" id="pink"/>
                            <label for="pink"><span class="pink"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <span class="status">товар под заказ</span>
                        <p class="delivery">срок доставки 20 дней</p>
                        <br>
                        <p><b>Характеристики</b></p>
                        <p>Толщина линии: 1.2 мм; Материал корпуса: сталь; Замена стержня: есть</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
        <div class="load-more">
            <img src="images/system/load-more.png" alt="">
            <p>Загрузить еще <br>15 товаров</p>
        </div>
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
