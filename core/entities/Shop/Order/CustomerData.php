<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:06
 */

namespace core\entities\Shop\Order;

class CustomerData
{
    public $phone;
    public $name;

    public function __construct($phone, $name)
    {
        $this->phone = $phone;
        $this->name = $name;
    }
}