<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 16.08.17
 * Time: 10:22
 */

namespace core\repositories\Shop;

use core\dispatchers\EventDispatcher;
use core\entities\Shop\Product\Product;
use core\repositories\NotFoundException;
use core\repositories\events\EntityPersisted;
use core\repositories\events\EntityRemoved;

class ProductRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function get($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException('Product is not found');
        }
        return $product;
    }

    public function existByBrand($id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }

    public function existByMainCategory($id): bool
    {
        return Product::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error');
        }
        $this->dispatcher->dispatchAll($product->releaseEvents());
        $this->dispatcher->dispatch(new EntityPersisted($product));
    }

    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new \RuntimeException('Removing Error');
        }
        $this->dispatcher->dispatchAll($product->releaseEvents());
        $this->dispatcher->dispatch(new EntityRemoved($product));
    }

}