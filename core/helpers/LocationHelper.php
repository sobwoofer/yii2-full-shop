<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.12.17
 * Time: 15:38
 */

namespace core\helpers;


use core\services\location\LocationManager;
use Yii;

class LocationHelper
{
    public static function getWarehouseId()
    {

        $location = Yii::$container->get(LocationManager::class);

        return $location->getWarehouseId();
    }

}