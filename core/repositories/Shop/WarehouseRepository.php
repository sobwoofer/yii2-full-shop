<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:38
 */

namespace core\repositories\Shop;


use core\entities\Shop\Warehouse;
use core\repositories\NotFoundException;

class WarehouseRepository
{
    public function get($id): Warehouse
    {
        if (!$warehouse = Warehouse::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Warehouse is not found.');
        }
        return $warehouse;
    }

    public function save(Warehouse $warehouse): void
    {
        if (!$warehouse->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Warehouse $warehouse): void
    {
        if (!$warehouse->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
    

}