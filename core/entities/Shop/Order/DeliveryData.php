<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:07
 */

namespace core\entities\Shop\Order;

class DeliveryData
{
    public $index;
    public $address;

    public function __construct($index, $address)
    {
        $this->index = $index;
        $this->address = $address;
    }
}