<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.10.17
 * Time: 12:28
 */

namespace core\repositories\events;

class EntityRemoved
{
    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }
}