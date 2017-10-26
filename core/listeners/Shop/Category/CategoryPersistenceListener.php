<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.10.17
 * Time: 17:59
 */

namespace core\listeners\Shop\Category;

use core\entities\Blog\Category;
use core\repositories\events\EntityPersisted;
use yii\caching\Cache;
use yii\caching\TagDependency;

class CategoryPersistenceListener
{
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function handle(EntityPersisted $event): void
    {
        if ($event->entity instanceof Category) {
            TagDependency::invalidate($this->cache, ['categories']);
        }
    }
}