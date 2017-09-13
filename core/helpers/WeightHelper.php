<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.09.17
 * Time: 16:07
 */

namespace croe\helpers;

class WeightHelper
{
    public static function format($weight): string
    {
        return $weight / 1000 . ' kg';
    }
}