<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.10.17
 * Time: 14:42
 */

namespace console\controllers;


use yii\base\Object;
use yii\queue\Job;

class TestQueueJob extends Object implements Job
{
    public $name;

    public function execute($queue)
    {
        file_put_contents(__DIR__ . '/queueTest.txt', $this->name);
    }

}