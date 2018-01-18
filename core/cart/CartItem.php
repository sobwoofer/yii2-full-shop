<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:57
 */

namespace core\cart;

use core\cart\cost\Discount;
use core\entities\Shop\DeliveryTerm;
use core\entities\Shop\Order\ModificationWrapper;
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

    public function getDeliveryTerm(): DeliveryTerm
    {
        return $this->product->warehousesProduct->deliveryTerm;
    }

    public function getModificationAssignments(): ?array
    {
        return $this->modificationAssignments;
    }

    /**
     * @return \core\entities\Shop\Modification\Modification[]
     */
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
    public function getModificationsCost(): float
    {
        $total = 0;
        if ($this->modificationAssignments) {
            foreach ($this->modificationAssignments as $modificationAssignment) {
                $total += $this->getModificationCost($modificationAssignment->modification_id);
            }
        }
        return $total;
    }

    public function getModificationQuantity($id): ?int
    {
        foreach ($this->getModifications() as $modification) {
           if ($modification->isIdEqualTo($id)){
              $quantity = $modification->group->depend_qty ? $this->getQuantity() : 1;
           }
         }

        return $quantity ?? null;
    }

    public function getModificationsPrepared(): array
    {
        foreach ($this->getModifications() as $modification) {
            $result[] = new ModificationWrapper(
                $modification->id,
                $modification->code,
                $modification->price,
                $this->getModificationCost($modification->id),
                $this->getModificationQuantity($modification->id),
                $modification->name
            );
        }
        return $result ?? [];
    }

    public function isCanDiscount()
    {
        return !$this->isSpecial() && $this->product->category->isBeInDiscount() && $this->product->isBeInDiscount();
    }

    public function getModificationCost($id): float
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

    public function getPrice(): float
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

    public function getCost(): float
    {
        return $this->getPrice() * $this->quantity;
    }

    public function getCostWithoutAnyDiscount(): float
    {
        return $this->getPriceWithoutAnyDiscount() * $this->quantity;
    }

    public function getPriceWithoutAnyDiscount(): ?float
    {
        if (!$this->isSpecial() && $this->isCanDiscount()) {
            $result = $this->getPrice();
        } elseif($this->isSpecial()) {
            $result = $this->product->warehousesProduct->price;
        }

        return $result ?? null;
    }

    public function getPriceWithDiscount($discountPercent): float
    {
        if (!$this->isSpecial() && $this->isCanDiscount()) {
            $result = $this->getPrice() - $this->getPrice() / 100 * $discountPercent;
        }
        return $result ?? $this->getPrice();
    }

    public function getDiscountPercent($discountPercent): float
    {
        if (!$this->isSpecial() && $this->isCanDiscount()) {
            $result = $discountPercent;
        } else {
            $result = $this->product->warehousesProduct->getSpecialPercent();
        }
        return $result;
    }

    public function isDiscounted($discountPercent): bool
    {
        return $this->isCanDiscount() && $discountPercent > 0;
    }

    public function getDiscountedPrice($discountPercent)
    {
        return $this->getPrice()  - $this->getPrice() / 100 * $discountPercent;
    }

    /**
     * @param int $discountPercent
     * @return float
     */
    public function getCostWithDiscount($discountPercent): float
    {

        if (!$this->isSpecial() && $this->isCanDiscount()) {
            $result = $this->getCost() - $this->getCost() / 100 * $discountPercent;
        }
        return $result ?? $this->getCost();
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