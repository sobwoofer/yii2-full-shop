<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:57
 */

namespace core\cart;

use core\entities\Shop\Product\Modification;
use core\entities\Shop\Product\ModificationAssignment;
use core\entities\Shop\Product\Product;

/**
 * Class CartItem
 * @package core\cart
 * @property ModificationAssignment[] $modificationAssignments
 * @property integer $quantity
 * @property Product $product
 */
class CartItem
{
    private $product;
    private $modificationAssignments;
    private $quantity;

    public function __construct(Product $product, $modificationAssignments, $quantity)
    {
        $product->canBeCheckout($modificationAssignments, $quantity);

        $this->product = $product;
        $this->modificationAssignments = $modificationAssignments;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return md5(serialize([$this->product->id, $this->product->code]));
    }

    public function getProductId(): int
    {
        return $this->product->id;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getModificationAssignments(): ?array
    {
        return $this->modificationAssignments;
    }

    public function getModifications(): array
    {
        if ($modificationAssignments = $this->modificationAssignments){
            foreach ($this->modificationAssignments as $assignment) {
                $modifications[] = $assignment->modification;
            }
        }
        return $modifications ?? [];
    }

//    public function getModification(): ?Modification
//    {
//        if ($this->modificationId) {
//            return $this->product->getModification($this->modificationId);
//        }
//        return null;
//    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * sum all modification's prices of this item product in cart
     * @return int
     */
    public function getModificationsCost(): int
    {
        $total = 0;
        if ($this->modificationAssignments) {
            foreach ($this->modificationAssignments as $modificationAssignment) {
                $total += $this->getModificationCost($modificationAssignment->modification_id);
            }
        }
        return $total;
    }

    public function getModificationCost($id): int
    {
        $result = 0;
        foreach ($this->modificationAssignments as $modificationAssignment) {
            if ($modificationAssignment->modification->isIdEqualTo($id)) {
                if ($modificationAssignment->modification->group->depend_qty) {
                    $result = $this->product->getModificationPrice($modificationAssignment->modification_id) * $this->quantity;
                } else {
                    $result =  $this->product->getModificationPrice($modificationAssignment->modification_id);
                }
            }
        }
        return $result;
    }

    public function getPrice(): int
    {
        if ($this->isSpecial()) {
            return $this->product->warehousesProduct->special;
         }

        return $this->product->warehousesProduct->price;
    }

    public function isSpecial(): bool
    {
        return $this->product->warehousesProduct->isSpecial();
    }

    public function getWeight(): int
    {
        return $this->product->weight * $this->quantity;
    }

    public function getCost(): int
    {
        return $this->getPrice() * $this->quantity;
    }

    public function getFullCost(): int
    {
        return $this->getCost() + $this->getModificationsCost();
    }

    public function plus($quantity)
    {
        return new static($this->product, $this->modificationAssignments, $this->quantity + $quantity);
    }

    public function changeQuantity($quantity)
    {
        return new static($this->product, $this->modificationAssignments, $quantity);
    }

}