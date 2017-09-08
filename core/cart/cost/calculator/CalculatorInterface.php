<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:47
 */

namespace core\cart\cost\calculator;

use core\cart\CartItem;
use core\cart\cost\Cost;

interface CalculatorInterface
{

    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function  getCost(array $items): Cost;
}