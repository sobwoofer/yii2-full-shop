<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.01.18
 * Time: 13:00
 */

namespace core\cart\view;


class LoadStatus
{
    public $loaded;
    public $statusMessage;
    public $code;
    public $quantity;


    public function __construct($loaded, $statusMessage, $code, $quantity)
    {
        $this->loaded = $loaded;
        $this->statusMessage = $statusMessage;
        $this->code = $code;
        $this->quantity = $quantity;
    }

}