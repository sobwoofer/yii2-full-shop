<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.01.18
 * Time: 16:53
 */

namespace core\repositories\Shop;


use core\entities\Shop\Discount;
use core\repositories\NotFoundException;

class DiscountRepository
{
    public function get($id): Discount
    {
        if (!$discount = Discount::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('DeliveryMethod is not found.');
        }
        return $discount;
    }


    public function save(Discount $discount): void
    {
        if (!$discount->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Discount $discount): void
    {
        if (!$discount->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}