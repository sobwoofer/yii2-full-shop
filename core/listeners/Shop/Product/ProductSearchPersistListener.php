<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.10.17
 * Time: 12:34
 */

namespace core\listeners\Shop\Product;

use core\entities\Shop\Product\Product;
use core\repositories\events\EntityPersisted;
use core\services\search\ProductIndexer;
use yii\caching\Cache;
use yii\caching\TagDependency;

class ProductSearchPersistListener
{
    private $indexer;
    private $cache;

    public function __construct(ProductIndexer $indexer, Cache $cache)
    {
        $this->indexer = $indexer;
        $this->cache = $cache;
    }

    public function handle(EntityPersisted $event): void
    {
        if ($event->entity instanceof Product) {
            if ($event->entity->isActive()) {
                $this->indexer->index($event->entity);
            } else {
                $this->indexer->remove($event->entity);
            }
            TagDependency::invalidate($this->cache, ['products']);
        }
    }
}