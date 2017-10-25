<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.10.17
 * Time: 17:42
 */


namespace core\jobs\Shop\Product;

use core\entities\Shop\Product\Product;
use core\jobs\Job;

class ProductAvailabilityNotification extends Job
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}