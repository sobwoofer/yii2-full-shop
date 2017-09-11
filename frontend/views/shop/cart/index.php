<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 9:11
 */

/* @var $this yii\web\View */
/* @var $cart \core\cart\Cart */

use core\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Shopping Cart';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-page" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <h1 class="main-title uppercase"><?= Html::encode($this->title) ?></h1>

        <div class="custom-btn-wrp">
            <button class="custom-btn"><span class="icon"><img src="images/system/printer.png" alt="">&nbsp;&nbsp;Распечатать</span></button>
            <button class="custom-btn"><span class="icon"><img src="images/system/download.png" alt="">&nbsp;&nbsp;Скачать</span></button>
        </div>

        <div class="cart-table-wrp">
            <table>
                <tr>
                    <td></td>
                    <td>Наименование</td>
                    <td>Артикул</td>
                    <td>Цена, грн</td>
                    <td>Скидка</td>
                    <td>Количество</td>
                    <td>Сумма, грн</td>
                    <td>Наличие</td>
                </tr>

                <?php foreach ($cart->getItems() as $item): ?>
                    <?php
                    $product = $item->getProduct();
                    $modification = $item->getModification();
                    $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox">
                            <a href="<?= $url ?>">
                                <?php if ($product->mainPhoto): ?>
                                    <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_list') ?>" alt="" class="img-thumbnail" />
                                <?php endif; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                        </td>
                        <td class="text-left">
                            <?php if ($modification): ?>
                                <?= Html::encode($modification->name) ?>
                            <?php endif; ?>
                        </td>
                        <td><?= PriceHelper::format($item->getPrice()) ?></td>
                        <td>0%</td>
                        <td>
                            <?= Html::beginForm(['quantity', 'id' => $item->getId()]); ?>
                            <div class="input-group btn-block" style="max-width: 200px;">
                                <input type="text" name="quantity" value="<?= $item->getQuantity() ?>" size="1" class="form-control" />
                                <span class="input-group-btn">
                                    <button type="submit" title="" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                    <a title="Remove" class="btn btn-danger" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" data-method="post"><i class="fa fa-times-circle"></i></a>
                                </span>
                            </div>
                            <?= Html::endForm() ?>
                        </td>
                        <td><?= PriceHelper::format($item->getCost()) ?></td>
                        <td>В наличие</td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="table-nav">
                <ul>
                    <li><a href="#">Выделить все</a></li>
                    <li><a href="#">Удалить</a></li>
                </ul>
            </div>
            <?php $cost = $cart->getCost() ?>
            <div class="row" style="margin-top: 30px;">
                <div class="col-sm-6">
                    <p class=" delivery-time"> Срок поставки: <span class="red">3-4 дня</span></p>
                    <p>(в корзине присутствует товар под заказ)</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-right link-in-p">Доставка согласно <a href="#/">тарифов перевозчика </a>Новая почта</p>
                    <p class="text-right"><b>Стоимость (включая НДС): <span class="red price"><?= PriceHelper::format($cost->getOrigin()) ?></span></b></p>
                    <?php foreach ($cost->getDiscounts() as $discount): ?>
                        <p class="text-right"><?= Html::encode($discount->getName()) ?>: <span class="red"><?= PriceHelper::format($discount->getValue()) ?></span></p>
                    <?php endforeach; ?>
                    <p class="text-right"><b>Итого к оплате (включая НДС): <span class="red price"><?= PriceHelper::format($cost->getTotal()) ?></span></b></p>
                </div>
            </div>

            <div class="box" style="margin-top: 30px;">
                <div class="col-sm-6">
                    <form action="#">

                        <p>Быстрое добавление товара в корзину по артикулу</p>
                        <input type="text" class="input-add-tovar">
                        <input type="submit" value="Добавить" class="btn">
                        <p class="link-in-p"><a href="#" download="/">Скачать</a> каталог товаров (PDF,~56MB)</p>
                    </form>

                </div>
                <div class="col-sm-6">
                    <form action="#">

                        <p>Множественное добавление товаров в корзину из файла</p>

                        <div class="filebtnwrp">

                            <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn-add-tovar btn-file">
                            <span class="fileupload-new">ВЫБРАТЬ ФАЙЛ</span>
                            <span class="fileupload-exists">Изменить</span>
                            <input type="file"/></span>
                                <span class="fileupload-preview"></span>
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                            </div>

                        </div>
                        <!--<input type="file" class="btn-add-tovar">ВЫБРАТЬ ФАЙЛ</input>-->
                        <input type="submit" value="Добавить" class="btn">
                        <div class="clearfix"></div>
                        <p class="link-in-p"><a href="#" download="/">Скачать</a> пример файла (CSV)</p>
                    </form>

                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end box -->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="main-title uppercase">Оформить заказ</h1>
                </div>
                <div class="col-sm-6">

                    <div class="attention">
                        Внимание! Сумма минимального заказа: <br>
                        для города Киев - 500 грн.      для доставки по Украине - 750 грн
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-sm-offset-1 box checkout ">
                <form action="#">
                    <p class="form-title">Заполните контактные данные</p>
                    <input type="text" placeholder="Имя и фамилия *">
                    <input type="text" placeholder="Адрес *">
                    <input type="text" placeholder="Телефон *">
                    <input type="text" placeholder="Эл. почта *">
                    <textarea name="" id="" cols="30" rows="10" placeholder="Комментарии к заказу"></textarea>
                    <p class="info"><span class="red">*</span> поля обязательные к заполнению</p>
                    <p class="form-title">Заполните контактные данные</p>

                    <div class="wrp-input">
                        <p class="wrp-input-title">Способ оплаты</p>
                        <input type="text" placeholder="Безналичны расчет">
                        <a href="#/" class="wrp-input_more">подробнее</a>
                    </div>
                    <div class="wrp-input">
                        <p class="wrp-input-title">Способ доставки</p>
                        <input type="text" placeholder="Курьером по Киеву">
                        <a href="#/" class="wrp-input_more">подробнее</a>
                    </div>
                    <div class="adress-wrp">
                        <input type="text" placeholder="№ офиса" class="pull-left">
                        <input type="text" placeholder="№ этажа" class="pull-right">
                        <div class="clearfix"></div>
                    </div>
                    <?php if ($cart->getItems()): ?>
                        <input type="submit" value="Оформить заказ" href="index.php?route=checkout/checkout" class="btn uppercase">
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>







