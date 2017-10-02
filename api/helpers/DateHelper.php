<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 02.10.17
 * Time: 12:37
 */

namespace api\helpers;

class DateHelper
{
    public static function formatApi($timestamp)
    {
        return $timestamp ? date(DATE_RFC3339, $timestamp) : null;
    }
}