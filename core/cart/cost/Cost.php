<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:49
 */


namespace core\cart\cost;

final class Cost
{
    private $value;
    private $modificationsValue;
    private $discounts = [];

    public function __construct(float $value, float $modificationsValue = 0,  array $discounts = [])
    {
        $this->value = $value;
        $this->modificationsValue = $modificationsValue;
        $this->discounts = $discounts;
    }

    public function withDiscount(Discount $discount, $modificationsValue = 0): self
    {
        return new static($this->value, $modificationsValue, array_merge($this->discounts, [$discount]));
    }

    public function getOriginWithModifications(): float
    {
        return $this->value + $this->modificationsValue;
    }

    public function getOriginModifications(): float
    {
        return $this->modificationsValue;
    }

    public function getOrigin(): float
    {
        return $this->value;
    }

    public function getTotal(): float
    {
        return $this->value - array_sum(array_map(function (Discount $discount) {
                return $discount->getValue();
            }, $this->discounts));
    }

    /**
     * @return Discount[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }
}