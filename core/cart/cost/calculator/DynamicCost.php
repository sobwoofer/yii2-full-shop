<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 12:25
 */

namespace core\cart\cost\calculator;


use core\cart\CartItem;
use core\cart\cost\Cost;
use core\cart\cost\Discount as CartDiscount;
use core\entities\Shop\Discount as DiscountEntity;

class DynamicCost implements CalculatorInterface
{
    private $next;

    public function __construct(CalculatorInterface $next)
    {
        $this->next = $next;
    }

    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function getCost(array $items): Cost
    {
        /** @var DiscountEntity[] $discounts */
        //TODO need added repository for DuscountEntity Entity and get or save data from it
        $discounts = DiscountEntity::find()->active()->orderBy('sort')->all();

        $cost = $this->next->getCost($items);

        foreach ($discounts as $discount) {
            if ($discount->isEnabled() && $discount->isRightCostDiapason($cost->getOriginWithoutDiscount())) {
                $new = new CartDiscount($cost->getOrigin() * $discount->percent / 100, $discount->name, $discount->percent);
                $cost = $cost->withDiscount($new, $cost->getOriginSpecial(), $cost->getOriginModifications());
            }
        }

        return $cost;
    }

    public function getDiscountOfItem()
    {
        return $this->next;

    }

}