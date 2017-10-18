<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.10.17
 * Time: 15:15
 */

namespace core\dispatchers;


interface EventDispatcher
{
    public function dispatch($event): void;

}