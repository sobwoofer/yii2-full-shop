<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:14
 */

namespace core\readModels\Shop;


use core\entities\Shop\ExtraStatus;

class ExtraStatusReadRepository
{
    public function getAll(): array
    {
        return ExtraStatus::find()->all();
    }

}