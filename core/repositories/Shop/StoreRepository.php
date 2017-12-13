<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:53
 */

namespace core\repositories\Shop;


use core\entities\Shop\Store;
use core\repositories\NotFoundException;

class StoreRepository
{
    public function get($id): Store
    {
        if (!$store = Store::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Store is not found.');
        }
        return $store;
    }

    public function save(Store $store): void
    {
        if (!$store->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Store $store): void
    {
        if (!$store->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}