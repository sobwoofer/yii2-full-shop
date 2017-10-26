<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.10.17
 * Time: 15:40
 */

namespace core\jobs;

abstract class Job implements \yii\queue\Job
{
    public function execute($queue): void
    {
        $listener = $this->resolveHandler();
        $listener($this, $queue);
    }

    private function resolveHandler(): callable
    {
        return [\Yii::createObject(static::class . 'Handler'), 'handle'];
    }
}