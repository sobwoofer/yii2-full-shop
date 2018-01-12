<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:52
 */

namespace core\cart\cost;


final class Discount
{
    private $value;
    private $name;
    private $percent;

    public function __construct(float $value, string $name, int $percent)
    {
        $this->value = $value;
        $this->name = $name;
        $this->percent = $percent;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getPercent(): float
    {
        return $this->percent;
    }

    public function getName(): string
    {
        return $this->name;
    }
}