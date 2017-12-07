<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.10.17
 * Time: 15:24
 */

namespace core\readModels\Shop;

use core\entities\Shop\DeliveryMethod\DeliveryMethod;

class DeliveryMethodReadRepository
{
    public function getAll(): array
    {
        return DeliveryMethod::find()->orderBy('sort')->all();
    }
}