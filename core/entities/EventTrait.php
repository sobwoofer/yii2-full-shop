<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.10.17
 * Time: 12:38
 */

namespace core\entities;

trait EventTrait
{
    private $events = [];

    protected function recordEvent($event): void
    {
        $this->events[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}