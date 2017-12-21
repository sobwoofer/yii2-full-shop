<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:13
 */

namespace core\readModels\Shop;


use core\entities\Shop\DeliveryTerm;

class DeliveryTermReadRepository
{
    public function getAll(): array
    {
        return DeliveryTerm::find()->all();
    }

}