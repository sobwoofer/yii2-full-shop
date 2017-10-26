<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.10.17
 * Time: 12:34
 */

namespace core\listeners\Shop\Product;

use core\entities\Shop\Product\Product;
use core\repositories\events\EntityRemoved;
use core\services\search\ProductIndexer;

class ProductSearchRemoveListener
{
    private $indexer;

    public function __construct(ProductIndexer $indexer)
    {
        $this->indexer = $indexer;
    }

    public function handle(EntityRemoved $event): void
    {
        if ($event->entity instanceof Product) {
            $this->indexer->remove($event->entity);
        }
    }
}