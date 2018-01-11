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
use yii\widgets\Breadcrumbs;
use romkaChev\yii2\swiper\Swiper;
use yii\helpers\ArrayHelper;


$this->title = $product->name;

$this->registerMetaTag(['name' =>'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $product->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;
$this->params['active_category'] = $product->category;

?>

<div class="container">
    <section class="section section__gutter_top">

        <div class="hidden-sm hidden-xs">
            <div class="bread_crumbs">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => '']
                ]) ?>
            </div>
        </div>
        <div class="row" xmlns:fb="http://www.w3.org/1999/xhtml">
            <script>
                $(function(){
                    var galleryTop = new Swiper('.slider_wrapper .gallery-top', {
                        spaceBetween: 10,
                    });
                    var galleryThumbs = new Swiper('.slider_wrapper .gallery-thumbs', {
                        spaceBetween: 10,
                        centeredSlides: true,
                        slidesPerView: 3,
                        touchRatio: 0.2,
                        nextButton: '.slider_wrapper .sp .swiper-button-next',
                        prevButton: '.slider_wrapper .sp .swiper-button-prev',
                        direction: 'vertical',
                        slideToClickedSlide: true
                    });
                    galleryTop.params.control = galleryThumbs;
                    galleryThumbs.params.control = galleryTop;
                });

            </script>
            <div class="col-md-6 col-lg-6">
                <?php Swiper::widget() ?>
                <div class="slider_wrapper">

                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            <!-- //TODO i would like to connect this fancybox v. >=3.0 -->

                            <?php if (count($product->photos360)): ?>
                                <div class="swiper-slide">
                                    <a href="http://static.yii2-shop.test/cache/products360/8/product_big_0.jpg"
                                       class="Magic360" data-options="filename:product_main_{col}.jpg;
                       large-filename: product_big_{col}.jpg; columns:<?= count($product->photos360) ?>">
                                        <img src="http://static.yii2-shop.test/cache/products360/8/product_main_00.jpg"/>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php foreach ($product->photos as $i => $photo): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>" alt="<?= Html::encode($product->name) ?>">
                                        <a href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>" class="zoom_in" data-lightbox="image-1" data-title=""></a>
                                    </div>
                            <?php endforeach; ?>

                        </div>
                        <!-- Add Arrows -->
                    </div>
                    <div class="sp">

                        <div class="swiper-container gallery-thumbs">

                            <div class="swiper-wrapper">
                                <?php if (count($product->photos360)): ?>
                                    <div class="swiper-slide">
                                        <img src="/images/icons/360-Icon.png" alt="">
                                    </div>
                                <?php endif; ?>
                                <?php foreach ($product->photos as $i => $photo): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>

                    <div class="clearfix"></div>


                </div>
            </div>
            <div class="col-md-6">
                <h2 class="catalog-title catalog-title__one_product">
                    <strong><?= Html::encode($product->name) ?></strong>
                </h2>
                <div class="logo_economix">
                    <a href="<?= Url::to(['/shop/catalog/brand', 'id' => $product->brand->id]) ?>"><?= Html::img($product->brand->getThumbFileUrl('image', 'product_page')) ?></a>
                </div>


                <div class="product-line__item product-line__item__one_product">
                    <?php if ($product->isAvailable()): ?>
                    <?php $form = ActiveForm::begin([
                        'action' => ['/shop/cart/add', 'id' => $product->id],
                    ]) ?>
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

                    <?php if ($product->warehousesProduct->isSpecial() && $product->warehousesProduct->special_end): ?>
                        <!--color pick-->
                        <div class="timer_wrp one-product">
                            <p class="timer-title pull-left">
                                Скидка <br>
                                действует:
                            </p>

                            <div id="clock" class="timer" data-date-to="<?= gmdate('Y/m/d', $product->warehousesProduct->special_end) ?>"></div>
                            <div class="clearfix"></div>

                        </div>
                        <script type="text/template" id="clock-template">
                            <!-- //TODO countdown do not work -->
                            <div class="time <%= label %>">
                                <span class="count curr top"><%= curr %></span>
                                <span class="count next top"><%= next %></span>
                                <span class="count next bottom"><%= next %></span>
                                <span class="count curr bottom"><%= curr %></span>
                                <span class="label"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
                            </div>
                        </script>
                    <?php endif; ?>




                    <div class="one_product_details">

                        <div class="price_block price_stock">
                            <div class="goods_amount"><?= $product->warehousesProduct->extraStatus->name ?> <span class="goods_amount___icon"></span></div>
                            <?php if (!$product->warehousesProduct->isSpecial()): ?>
                                <p class="price__one_product"><?= PriceHelper::format($product->warehousesProduct->price) ?></p>
                            <?php else: ?>
                                <p class="price__one_product"><?= PriceHelper::format($product->warehousesProduct->price) ?></p>
                                <p class="price__one_product text-danger"><?= PriceHelper::format($product->warehousesProduct->special) ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- .price_block -->
                        <!-- .product-line__item__action-block -->
                        <div class="product-line__item__action-block">
                            <a href="<?= Url::to(['/cabinet/wishlist/add', 'id' => $product->id]) ?>" data-method="post" class="like">
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


                            <?php if ($modificationGroups = $cartForm->modificationsList()): ?>
                                <?php foreach ($modificationGroups as $key => $assignments): ?>
                                    <?= $form->field($cartForm, 'modifications[' . $key . ']')
                                        ->dropDownList(
                                            ArrayHelper::map($assignments, 'modification.id', 'modification.name'),
                                            ['prompt' => 'select mod',  'options' => $cartForm->getModificationDataAttributes()])
                                        ->label(reset($assignments)->modification->group->name)  ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
<!--                            <div class="one_product_details__square">Площадь нанесения-->
<!--                            </div>-->
<!--                            <div class="dropdown dropdown__one_product_details">-->
<!--                                <button class="dropdown-toggle dropdown_button__one_product_details" type="button" data-toggle="dropdown">Выберите размер-->
<!--                                    <span class="caret"></span></button>-->
<!--                                <ul class="dropdown-menu">-->
<!--                                    <li><a href="#">601-1247 см.кв.</a></li>-->
<!--                                    <li><a href="#">501-0000 см.кв.</a></li>-->
<!--                                    <li><a href="#">404-6666 см.кв</a></li>-->
<!--                                </ul>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                    <?php else: ?>

                        <div class="alert alert-danger">
                            The product is not available for purchasing right now.<br />Add it to your wishlist.
                        </div>

                    <?php endif; ?>
                </div>
                <div class="one_product_deal">
                    <div class="one_product_deal__item">
                        <span class="one_product_deal__icon one_product_deal__icon_delivery"></span>
                        <div class="one_product_deal__wrapper">
                            <div class="one_product_deal__title">Доставка</div>
                            <div class="one_product_deal__text">
                                Cрок поставки:
                                <?= $product->warehousesProduct->deliveryTerm->name ?>
                                с момента заказа
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
                    <div class="one_product_deal__item">
                        <span class="one_product_deal__icon one_product_deal__icon_economy"></span>
                        <div class="one_product_deal__wrapper">
                            <div class="one_product_deal__title">Инструкция</div>
                            <div class="one_product_deal__text">
                                <a href="<?= Yii::getAlias('@static/guides/' . $product->guide) ?>">Скачать файл</a>
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
                    <tbody>
                    <?php foreach ($product->values as $value): ?>
                        <?php if (!empty($value->value)): ?>
                            <tr>
                                <td><?= Html::encode($value->characteristic->name) ?></td>
                                <td><?= Html::encode($value->value) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="about">
                    <div class="sub-title sub-title__one_product"><strong>Описание</strong></div>
                    <?= Yii::$app->formatter->asHtml($product->description, [
                        'Attr.AllowedRel' => array('nofollow'),
                        'HTML.SafeObject' => true,
                        'Output.FlashCompat' => true,
                        'HTML.SafeIframe' => true,
                        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?>
                </div>
                <div class="about">
                    <div class="sub-title sub-title__one_product"><strong>Видео</strong></div>
                    <iframe width="100%"
                            height="350"
                            src="<?= $product->video ?>"
                            frameborder="0"
                            gesture="media"
                            allow="encrypted-media"
                            allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-5">
                <?= $this->render('_review', ['reviews' => $product->reviews, 'reviewForm' => $reviewForm]) ?>

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

<?= \frontend\widgets\Shop\OtherProductsOfCatWidget::widget(['limit' => 4, 'productId' => $product->id]) ?>
<?= \frontend\widgets\Shop\RelatedProductsWidget::widget(['productId' => $product->id]) ?>
<?= \frontend\widgets\Shop\BuyWithProductsWidget::widget(['productId' => $product->id]) ?>
