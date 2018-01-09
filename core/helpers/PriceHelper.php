<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:53
 */

namespace core\helpers;


class PriceHelper
{
    public static function format($price): string
    {
        return number_format($price, 0, '.', ' ') . self::getCurrencySymbol();
    }

    public static function getCurrencySymbol(): string
    {
        return ' грн.';
    }

}