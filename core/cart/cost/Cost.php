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
    private $specialValue;
    private $discounts = [];

    public function __construct(float $value, float $specialValue, float $modificationsValue, array $discounts = [])
    {
        $this->value = $value;
        $this->modificationsValue = $modificationsValue;
        $this->specialValue = $specialValue;
        $this->discounts = $discounts;
    }

    public function withDiscount(Discount $discount, $specialValue = 0, $modificationsValue = 0): self
    {
        return new static($this->value, $specialValue, $modificationsValue, array_merge($this->discounts, [$discount]));
    }

    public function getOriginWithoutDiscount(): float
    {
        return $this->getOrigin() + $this->getOriginModifications() + $this->getOriginSpecial();
    }

    public function getOriginModifications(): float
    {
        return $this->modificationsValue;
    }

    public function getOrigin(): float
    {
        return $this->value;
    }

    public function getOriginSpecial(): float
    {
        return $this->specialValue;
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