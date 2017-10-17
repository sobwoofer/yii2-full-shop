<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.10.17
 * Time: 11:21
 */

namespace core\services\sms;


interface SmsSender
{
    public function send($number, $text): void;

}