<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.10.17
 * Time: 15:23
 */

namespace shop\services\feed;

class ShopInfo
{
    public $name;
    public $company;
    public $url;

    public function __construct($name, $company, $url)
    {
        $this->name = $name;
        $this->company = $company;
        $this->url = $url;
    }
}