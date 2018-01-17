<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.01.18
 * Time: 14:35
 */

namespace core\entities\Shop\Order;


/**
 * Class ModificationWrapper
 * @package core\entities\Shop\Order
 * @property integer $id
 * @property string $code
 * @property string $quantity
 * @property float $price
 * @property float $cost
 * @property string $name
 */
class ModificationWrapper
{
    public $id;
    public $code;
    public $price;
    public $cost;
    public $quantity;
    public $name;

    public function __construct($id, $code, $price, $cost, $quantity, $name)
    {
        $this->id = $id;
        $this->code = $code;
        $this->price = $price;
        $this->cost = $cost;
        $this->quantity = $quantity;
        $this->name = $name;

    }
}