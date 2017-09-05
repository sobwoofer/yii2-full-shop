<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.09.17
 * Time: 9:57
 */

/* @var $this yii\web\View */
/* @var $product core\entities\Shop\Product\Product */
/* @var $cartForm core\forms\Shop\AddToCartForm */
/* @var $reviewForm core\forms\Shop\ReviewForm */


use yii\helpers\Html;
use core\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = $product->name;

$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $product->name;

?>

<div class="container">
    <section class="section section__gutter_top">
        <div class="row" xmlns:fb="http://www.w3.org/1999/xhtml">
            <div class="col-md-6 col-lg-6">
                <div class="slider_wrapper">

                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            <!-- //TODO i would like to connect this fancybox v. >=3.0 -->
                            <?php foreach ($product->photos as $i => $photo): ?>
                                <?php if ($i == 0): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" alt="<?= Html::encode($product->name) ?>">
                                        <a href="<?= $photo->getUploadedFileUrl('file') ?>" class="zoom_in" data-lightbox="image-1" data-title=""></a>
                                    </div>
                                <?php else: ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" alt="">
                                        <a href="<?= $photo->getUploadedFileUrl('file') ?>" class="zoom_in" data-lightbox="image-1" data-title=""></a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                        <!-- Add Arrows -->
                    </div>
                    <div class="sp">

                        <div class="swiper-container gallery-thumbs">

                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/small-img.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/sm.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/small-img.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/sm.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/small-img.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/sm.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/small-img.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="http://static.yii2-shop.dev/dev/one_product/sm.png" alt="">
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>

                    <div class="clearfix"></div>


                </div>
            </div>
            <div class="col-md-6 col-lg-5">
                <h2 class="catalog-title catalog-title__one_product">
                    <strong><?= Html::encode($product->name) ?></strong>
                </h2>
                <div class="logo_economix"></div>
                <div class="product-line__item product-line__item__one_product">
                    <?php $form = ActiveForm::begin() ?>
                    <!-- .product-line__title -->
                    <span class="vendor_code vendor_code__one_product">Артикул: <?= Html::encode($product->code) ?></span>
                    <!-- .price_block -->
                    <!--color pick-->
                    <div class="clearfix"></div>
                    <p class="color-wrp-title color-wrp-title__one_product">Цвет</p>
                    <div class="color-wrp color-wrp__one_product">
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
                    <!--color pick-->

                    <div class="timer_wrp one-product">
                        <p class="timer-title pull-left">
                            Скидка <br>
                            действует:
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
                    <div class="one_product_details">
                        <div class="price_block price_stock">
                            <div class="goods_amount">Товара много <span class="goods_amount___icon"></span></div>
                            <p class="price__one_product"><?= PriceHelper::format($product->price_new) ?></p>
                        </div>
                        <!-- .price_block -->
                        <!-- .product-line__item__action-block -->
                        <div class="product-line__item__action-block">
                            <a href="#" class="like">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </a>
                            <?= $form->field($cartForm, 'quantity', [
                                    'options' => ['class' => ''],
                                    'template' => '{input}',
                            ])->textInput([ 'type' => 'number', 'class' => ''])->label(false) ?>
                            <?= Html::submitButton('В КОРЗИНУ', ['class' => 'btn btn-to-cart']) ?>

                        </div>
                        <!-- .product-line__item__action-block -->
                        <div class="star"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="one_product_details one_product_details_gutterUp clearfix">
                        <div class="one_product_details__item clearfix">
                            <div class="one_product_details__logo">Нанесение логотипа(от 30 шт.) <span class="info" data-toggle="tooltip" data-placement="top"
                                                                                                       title="Tooltip on left"></span></div>
                        </div>
                        <div class="one_product_details__item clearfix">
                            <div class="one_product_details__uf_print">
                                <input type="checkbox" id="UF"> <label for="UF">УФ-печать</label><span class="info" data-toggle="tooltip" data-placement="top"
                                                                                                       title="Tooltip on left"></span>
                            </div>
                            <div class="one_product_details__summary">Итого: <span>1512.00 грн</span></div>
                        </div>
                        <div class="one_product_details__item clearfix">
                            <div class="one_product_details__square">Площадь нанесения

                            </div>
                            <?= $form->field($cartForm, 'modification')
                                ->dropDownList($cartForm->modificationsList(), ['prompt' => '--- Select ---'])->label(false) ?>

                            <div class="dropdown dropdown__one_product_details">
                                <button class="dropdown-toggle dropdown_button__one_product_details" type="button" data-toggle="dropdown">Выберите размер
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">601-1247 см.кв.</a></li>
                                    <li><a href="#">501-0000 см.кв.</a></li>
                                    <li><a href="#">404-6666 см.кв</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
                <div class="one_product_deal">
                    <div class="one_product_deal__item">
                        <span class="one_product_deal__icon one_product_deal__icon_delivery"></span>
                        <div class="one_product_deal__wrapper">
                            <div class="one_product_deal__title">Доставка</div>
                            <div class="one_product_deal__text">
                                Cрок поставки: 20 дня с момента заказа
                                Общие условия доставки
                            </div>
                        </div>
                    </div>
                    <div class="one_product_deal__item">
                        <span class="one_product_deal__icon one_product_deal__icon_pay"></span>
                        <div class="one_product_deal__wrapper">
                            <div class="one_product_deal__title">Оплата</div>
                            <div class="one_product_deal__text">
                                Наличный, безналичный расчет
                                Общие условия оплаты
                            </div>
                        </div>
                    </div>
                    <div class="one_product_deal__item">
                        <span class="one_product_deal__icon one_product_deal__icon_garanty"></span>
                        <div class="one_product_deal__wrapper">
                            <div class="one_product_deal__title">Гарантия</div>
                            <div class="one_product_deal__text">
                                Обмен товара в течение 14 дн.
                            </div>
                        </div>
                    </div>
                    <div class="one_product_deal__item">
                        <span class="one_product_deal__icon one_product_deal__icon_economy"></span>
                        <div class="one_product_deal__wrapper">
                            <div class="one_product_deal__title">Экономия</div>
                            <div class="one_product_deal__text">
                                Цена действительна только для заказа через интернет-магазина. В магазинах и при заказе через телефон, цена может отличаться.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="sub-title sub-title__one_product"><strong>Харастеристики</strong></div>
                <table class="character">
                    <tr>
                        <td>Матеріал обкладинки</td>
                        <td>Просмолена тканина "Молескін"</td>
                    </tr>
                    <tr>
                        <td>Корпус</td>
                        <td>стальной</td>
                    </tr>
                    <tr>
                        <td>Покрытие</td>
                        <td>матовое</td>
                    </tr>
                    <tr>
                        <td>Перо</td>
                        <td>сталь</td>
                    </tr>
                </table>
                <div class="about">
                    <div class="sub-title sub-title__one_product"><strong>Описание</strong></div>
                    <?= Yii::$app->formatter->asNtext($product->description) ?>
                </div>
            </div>
            <div class="col-md-5">
            <!--   //TODO need move code of review in other template-->
                <div class="sub-title sub-title__one_product sub-title__review_block"><strong>Отзывы пользователей</strong> <span
                            class="review_block_amount">56</span></div>
                <a id="btn__review_block" class="btn btn__review_block">Оставить отзыв</a>
                <div class="review_wrapper">
                    <div class="review_block clearfix">
                        <div class="review_block__header">
                            <div class="review_block__name">Олег</div>
                            <div class="review_block__rating">
                                <div class="star"></div>
                            </div>
                            <div class="review_block__date">22.12.2017</div>
                        </div>
                        <div class="review_block__message">
                            В принципе, когда выбирал ручку, мне все продавцы говорили про ручки этой фирмы. Я их послушал и купил. Уже неделю она у меня.
                        </div>
                        <div class="review_block__footer">
                            <div class="review_block__answer"><span class="review_block__icon review_block__icon_answer"></span>ответить</div>
                            <div class="review_block__comment"><span class="review_block__icon review_block__icon_comment"></span>4 ответа</div>
                        </div>
                    </div>
                    <div class="review_block clearfix">
                        <div class="review_block__header">
                            <div class="review_block__name">Олег</div>
                            <div class="review_block__rating">
                                <div class="star"></div>
                            </div>
                            <div class="review_block__date">22.12.2017</div>
                        </div>
                        <div class="review_block__message">
                            В принципе, когда выбирал ручку, мне все продавцы говорили про ручки этой фирмы. Я их послушал и купил. Уже неделю она у меня.
                        </div>
                        <div class="review_block__footer">
                            <div class="review_block__answer"><span class="review_block__icon review_block__icon_answer"></span>ответить</div>
                            <div class="review_block__comment"><span class="review_block__icon review_block__icon_comment"></span>4 ответа</div>
                        </div>
                    </div>
                    <div class="review_block clearfix">
                        <div class="review_block__header">
                            <div class="review_block__name">Олег</div>
                            <div class="review_block__rating">
                                <div class="star"></div>
                            </div>
                            <div class="review_block__date">22.12.2017</div>
                        </div>
                        <div class="review_block__message">
                            В принципе, когда выбирал ручку, мне все продавцы говорили про ручки этой фирмы. Я их послушал и купил. Уже неделю она у меня.
                        </div>
                        <div class="review_block__footer">
                            <div class="review_block__answer"><span class="review_block__icon review_block__icon_answer"></span>ответить</div>
                            <div class="review_block__comment"><span class="review_block__icon review_block__icon_comment"></span>4 ответа</div>
                        </div>
                    </div>
                    <a href="#" class="read_more pull-left">смотреть все отзывы <span></span></a>
                </div>
                <div class="live_review">
                    <a class="btn btn_grey">Оставить отзыв</a>
                    <div class="clearfix"></div>
                    <?php if (Yii::$app->user->isGuest): ?>

                        <div class="panel-panel-info">
                            <div class="panel-body">
                                Please <?= Html::a('Log In', ['/auth/auth/login']) ?> for writing a review.
                            </div>
                        </div>

                    <?php else: ?>
                    <div class="comment_window">
                        <?php $form = ActiveForm::begin(['id' => 'form-review']) ?>
                        <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '--- Select ---']) ?>
                            <div class="clearfix">
                                <span class="star"></span>
                                <?= \alfa6661\widgets\Raty::widget([
                                    'name' => 'user-vote',
                                    'options' => [
                                        // the HTML attributes for the widget container
                                    ],
                                    'pluginOptions' => [
                                        // the options for the underlying jQuery Raty plugin
                                        // see : https://github.com/wbotelhos/raty#options
                                    ]
                                ]) ?>

                                <span>Оценка</span>
                                <div class="pull-right close-live_review"><img src="http://static.yii2-shop.dev/dev/one_product/close_one_pro-act.png" alt=""></div>
                            </div>
                            <p class="clearfix">
                                <?= $form->field($reviewForm, 'text')
                                    ->textarea(['rows' => 5, 'class' => 'comment_window__text', 'placeholder' => 'Коментарий...'])
                                    ->label(false) ?>
                            </p>
                            <?= Html::submitButton('Оставить отзыв', ['class' => 'btn btn__review_block btn__review_block_left clearfix']) ?>

                        <p class="comment_window__important clearfix">Важно! Чтобы Ваш отзыв либо комментарий прошел модерацию и был опубликован, ознакомьтесь,
                                пожалуйста, с нашими правилами!
                            </p>
                        <?php ActiveForm::end() ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</div>
<hr>
<div class="container">
    <section class="section section_good_deal">
        <h2 class="text-uppercase">ВМЕСТЕ ДЕШЕВЛЕ</h2>
        <div class="list_pair">
            <div class="list_pair__items">
                <div class="list_pair__icon"></div>
                <div class="list_pair__disc">Дырокол Economix, 20 л, металлический</div>
            </div>
            <div class="big_char">+</div>
            <div class="list_pair__items">
                <div class="list_pair__icon"></div>
                <div class="list_pair__disc">Дырокол Economix, 20 л, металлический</div>
            </div>
            <div class="big_char">=</div>
            <div class="list_pair__items">
                <div class="list_pair__icon"></div>
                <div class="list_pair__disc">Дырокол Economix, 20 л, металлический</div>
            </div>
        </div>
    </section>
</div>
<hr>

<?= \frontend\widgets\OtherProductsOfCatWidget::widget(['limit' => 4, 'productId' => $product->id]) ?>
