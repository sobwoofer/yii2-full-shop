<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.09.17
 * Time: 16:26
 */

namespace core\useCases\manage\Shop;

use core\entities\Shop\Order\CustomerData;
use core\entities\Shop\Order\DeliveryData;
use core\forms\manage\Shop\Order\OrderEditForm;
use core\repositories\Shop\DeliveryMethodRepository;
use core\repositories\Shop\OrderRepository;
use core\repositories\Shop\PaymentMethodRepository;

class OrderManageService
{
    private $orders;
    private $deliveryMethods;
    private $paymentMethods;

    public function __construct(
        OrderRepository $orders,
        DeliveryMethodRepository $deliveryMethods,
        PaymentMethodRepository $paymentMethods
    )
    {
        $this->orders = $orders;
        $this->deliveryMethods = $deliveryMethods;
        $this->paymentMethods = $paymentMethods;
    }

    public function edit($id, OrderEditForm $form): void
    {
        $order = $this->orders->get($id);

        $order->edit(
            new CustomerData(
                $form->customer->firstName,
                $form->customer->lastName,
                $form->customer->email,
                $form->customer->phone
            ),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->address
            )
        );

        $order->setPaymentInfo(
            $this->paymentMethods->get($form->payment->method)
        );

        $this->orders->save($order);
    }

    public function remove($id): void
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }
}