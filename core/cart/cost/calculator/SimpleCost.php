<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:48
 */

namespace core\cart\cost\calculator;

use core\cart\CartItem;
use core\cart\cost\Cost;

/**
 * Class SimpleCost
 * @package core\cart\cost\calculator
 */
class SimpleCost implements CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function getCost(array $items): Cost
    {
        $cost = 0;
        $modificationsCost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
            $modificationsCost += $item->getModificationsCost();
        }
        return new Cost($cost, $modificationsCost);
    }

}