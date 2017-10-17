<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.10.17
 * Time: 12:25
 */

namespace core\services\sms;


/**
 * Класс заглушка
 * Class DumpSmsSender
 * @package core\services\sms
 */
class DummySmsSender implements SmsSender
{
    public function send($number, $text): void
    {
       \Yii::info('Message to '. $number . ': ' . $text);
    }

}