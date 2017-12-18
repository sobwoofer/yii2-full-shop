<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.12.17
 * Time: 11:15
 */

namespace core\readModels;


use core\entities\Shop\Warehouse;

class WarehouseReadRepository
{
    public function getAll(): array
    {
        return Warehouse::find()->all();
    }

    public function find($id): ?Warehouse
    {
        return Warehouse::find()->andWhere(['id' => $id])->one();
    }

    public function findDefault(): ?Warehouse
    {
        return Warehouse::find()->andWhere(['default' => true])->one();
    }
}