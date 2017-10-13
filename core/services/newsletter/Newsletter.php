<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.10.17
 * Time: 10:56
 */

namespace core\services\newsletter;

interface Newsletter
{
    public function subscribe($email): void;
    public function unsubscribe($email): void;
}