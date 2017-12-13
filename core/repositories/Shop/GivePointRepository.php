<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:40
 */

namespace core\repositories\Shop;

use core\entities\Shop\GivePoint;
use core\repositories\NotFoundException;

class GivePointRepository
{
    public function get($id): GivePoint
    {
        if (!$givePoint = GivePoint::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Give point is not found.');
        }
        return $givePoint;
    }

    public function save(GivePoint $givePoint): void
    {
        if (!$givePoint->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(GivePoint $givePoint): void
    {
        if (!$givePoint->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function existByWarehouse($id)
    {
        return GivePoint::find()->andWhere(['warehouse_id' => $id])->exists();
    }

}