<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:38
 */

namespace core\useCases\Shop;

use core\cart\Cart;
use core\cart\CartItem;
use core\entities\Shop\Order\CustomerData;
use core\entities\Shop\Order\DeliveryData;
use core\entities\Shop\Order\Order;
use core\entities\Shop\Order\OrderItem;
use core\forms\Shop\Order\OrderForm;
use core\repositories\Shop\DeliveryMethodRepository;
use core\repositories\Shop\OrderRepository;
use core\repositories\Shop\ProductRepository;
use core\repositories\UserRepository;
use core\services\TransactionManager;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;
    private $deliveryMethods;
    private $transaction;

    public function __construct(
        Cart $cart,
        OrderRepository $orders,
        ProductRepository $products,
        UserRepository $users,
        DeliveryMethodRepository $deliveryMethods,
        TransactionManager $transaction
    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
        $this->deliveryMethods = $deliveryMethods;
        $this->transaction = $transaction;
    }

    //TODO need add checkoutGuest method for not authorization users.
    public function checkout($userId, OrderForm $form): Order
    {
        $user = $this->users->get($userId);

        $products = [];

        $items = array_map(function (CartItem $item) {
            $product = $item->getProduct();
            $product->checkout($item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationsPrepared(),
                $item->getPriceWithoutAnyDiscount($this->cart->getCost()->getDiscountPercent()),
                $item->getPriceWithDiscount($this->cart->getCost()->getDiscountPercent()),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        $order = Order::create(
            $user->id,
            new CustomerData(
                $form->customer->phone,
                $form->customer->name
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->index,
                $form->delivery->address
            )
        );

        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            $this->cart->clear();
        });

        return $order;
    }
}