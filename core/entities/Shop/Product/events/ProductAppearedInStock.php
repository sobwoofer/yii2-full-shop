<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.10.17
 * Time: 13:14
 */

namespace core\entities\Shop\Product\events;

use core\entities\Shop\Product\Product;

class ProductAppearedInStock
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}