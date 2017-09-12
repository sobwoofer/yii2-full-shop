<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:37
 */

namespace core\repositories\Shop;

use core\entities\Shop\Order\Order;
use core\repositories\NotFoundException;

class OrderRepository
{
    public function get($id): Order
    {
        if (!$order = Order::findOne($id)) {
            throw new NotFoundException('Order is not found.');
        }
        return $order;
    }

    public function save(Order $order): void
    {
        if (!$order->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Order $order): void
    {
        if (!$order->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}