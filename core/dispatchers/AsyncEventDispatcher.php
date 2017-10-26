<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.10.17
 * Time: 11:50
 */

namespace core\dispatchers;

use core\jobs\AsyncEventJob;
use yii\queue\Queue;

class AsyncEventDispatcher implements EventDispatcher
{
    private $queue;

    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event);
        }
    }

    public function dispatch($event): void
    {
        $this->queue->push(new AsyncEventJob($event));
    }

}