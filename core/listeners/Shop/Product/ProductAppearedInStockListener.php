<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.10.17
 * Time: 17:44
 */

namespace core\listeners\Shop\Product;

use core\entities\Shop\Product\events\ProductAppearedInStock;
use core\jobs\Shop\Product\ProductAvailabilityNotification;
use core\repositories\UserRepository;

use yii\queue\Queue;

class ProductAppearedInStockListener
{
    private $queue;

    public function __construct(UserRepository $users, Queue $queue)
    {
        $this->queue = $queue;
    }

    public function handle(ProductAppearedInStock $event): void
    {
        if ($event->product->isActive()) {
            $this->queue->push(new ProductAvailabilityNotification($event->product));
        }
    }
}