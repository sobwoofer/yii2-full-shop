<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.09.17
 * Time: 9:20
 */

use core\entities\Shop\Order\Order;
use core\helpers\OrderHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use core\helpers\PriceHelper;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $order Order */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="hidden-sm hidden-xs">
        <div class="bread_crumbs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => '']
            ]) ?>
        </div>
    </div>

    <h2 class="catalog-title"><b><?= Html::encode($this->title); ?></b></h2>
    <p>Представлена информация за последние 6 месяцев, Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></p>



    <div class="orders_tab">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php foreach ($dataProvider->getModels() as $order): ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree<?= $order->id ?>">
                        <div class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion<?= $order->id ?>" href="#collapseThree<?= $order->id ?>" aria-expanded="true" aria-controls="collapseOne">
                    <span class="col-sm-3 order_item_number text-center">
                        <b>№ <?= $order->id ?></b> <br>
                        <?= Yii::$app->formatter->asDatetime($order->created_at); ?>
                    </span>
                         <span class="col-sm-3 order_item_status status_done  text-center">
                            <?= OrderHelper::statusLabel($order->current_status); ?>
                         <span class="icon-wrp"><img src="/images/system/orders_icon_done.png" alt=""></span>
                    </span>
                    <!-- <span class="col-sm-3 order_item_status status_canceled text-center">-->
                    <!--     Отменен <span class="icon-wrp"><img src="./images/system/orders_icon_canceled.png" alt=""></span>-->
                    <!-- </span>-->
                    <span class="col-sm-3 order_item_items">
                        <?= count($order->items); ?> товаров на <?= PriceHelper::format($order->cost); ?>
                    </span>
                                <span class="col-sm-3 text-center order_item_more">
                        <span class="s">
                            подробнее
                        </span>
                        <span class="h">
                            кратко
                        </span>
                    </span>
                                <span class="clearfix"></span>
                            </a>
                        </div>
                    </div>
                    <div id="collapseThree<?= $order->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree<?= $order->id ?>">
                        <div class="panel-body">
                            <?php foreach ($order->items as $item): ?>
                                <div class="row row_items ">
                                    <div class="col-sm-1 col-sm-offset-1">
                                        <img src="<?= $item->product->mainPhoto->getThumbFileUrl('file', 'cart_list') ?>" alt="">
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="orders_item__title"><?= $item->product_name ?></p>
                                        <p class="price"><?= PriceHelper::format($item->price); ?></p>
                                    </div>
                                    <div class="col-sm-2 text-center"><?= $item->quantity ?></div>
                                    <div class="col-sm-2 text-center"><?= PriceHelper::format($item->price); ?></div>
                                </div>
                            <?php endforeach; ?>

                            <div class="row row_items total">
                                <div class="col-sm-3">
                                    <b>Адрес доставки</b>
                                    <br>
                                    <p><?= $order->delivery_address ?></p>
                                </div>
                                <div class="col-sm-3">
                                    <b>Оплата</b>
                                    <br>
                                    <p>наличными</p>
                                </div>
                                <div class="col-sm-3">
                                    <p>Итого к оплате: </p>
                                </div>
                                <div class="col-sm-3">
                                    <b><?= PriceHelper::format($order->cost); ?></b>
                                </div>
                            </div>
                            <p><?= $order->note ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
        ]) ?>
    </div>

