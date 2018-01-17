<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:49
 */


namespace core\cart\cost;

/**
 * Class Cost
 * @package core\cart\cost
 * @property Discount[] $discounts
 */
final class Cost
{
    private $value;
    private $modificationsValue;
    private $specialValue;
    private $costWithoutAnyDiscount;
    private $discounts = [];

    public function __construct(float $value, float $specialValue, float $modificationsValue,  float $costWithoutAnyDiscount, array $discounts = [])
    {
        $this->value = $value;
        $this->modificationsValue = $modificationsValue;
        $this->costWithoutAnyDiscount = $costWithoutAnyDiscount;
        $this->specialValue = $specialValue;
        $this->discounts = $discounts;
    }

    public function withDiscount(Discount $discount, $specialValue = 0, $modificationsValue = 0, $costWithoutAnyDiscount): self
    {
        return new static($this->value, $specialValue, $modificationsValue, $costWithoutAnyDiscount, array_merge($this->discounts, [$discount]));
    }

    /**
     * return sum cost of all cart items without percent discount from total, but with special prices of products
     * @return float
     */
    public function getOriginWithoutDiscount(): float
    {
        return $this->getOrigin() + $this->getOriginModifications() + $this->getOriginSpecial();
    }

    /**
     * return sum cost of all cart items without any discounts (percent from total and special prices of products oldPrice)
     * @return float
     */
    public function getOriginWithoutAnyDiscount(): float
    {
        return $this->costWithoutAnyDiscount + $this->getOriginModifications();
    }

    public function getOriginModifications(): float
    {
        return $this->modificationsValue;
    }

    public function getOrigin(): float
    {
        return $this->value;
    }



    public function getDiscountPercent(): int
    {
        $result = 0;
        foreach ($this->discounts as $discount) {
            $result += $discount->getPercent() ?? 0;
        }
        return $result;
    }

    public function getOriginSpecial(): float
    {
        return $this->specialValue;
    }

    public function getCostAllDiscount()
    {
        return  $this->getOriginWithoutAnyDiscount() - $this->getTotal();
    }

    public function getTotal(): float
    {
        return $this->value - array_sum(array_map(function (Discount $discount) {
                return $discount->getValue();
            }, $this->discounts)) + $this->getOriginModifications() + $this->getOriginSpecial();
    }

    /**
     * @return Discount[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }
}