<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.09.17
 * Time: 16:26
 */

namespace core\services\manage\Shop;

use core\entities\Shop\Order\CustomerData;
use core\entities\Shop\Order\DeliveryData;
use core\forms\manage\Shop\Order\OrderEditForm;
use core\repositories\Shop\DeliveryMethodRepository;
use core\repositories\Shop\OrderRepository;

class OrderManageService
{
    private $orders;
    private $deliveryMethods;

    public function __construct(OrderRepository $orders, DeliveryMethodRepository $deliveryMethods)
    {
        $this->orders = $orders;
        $this->deliveryMethods = $deliveryMethods;
    }

    public function edit($id, OrderEditForm $form): void
    {
        $order = $this->orders->get($id);

        $order->edit(
            new CustomerData(
                $form->customer->phone,
                $form->customer->name
            ),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->index,
                $form->delivery->address
            )
        );

        $this->orders->save($order);
    }

    public function remove($id): void
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }
}