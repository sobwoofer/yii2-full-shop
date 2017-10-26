<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.10.17
 * Time: 11:52
 */

namespace core\jobs;

class AsyncEventJob extends Job
{
    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }
}