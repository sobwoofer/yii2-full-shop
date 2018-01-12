<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.12.17
 * Time: 10:56
 */

namespace core\entities\Shop\Product;


use core\entities\Shop\Product\queries\WarehousesProductQuery;
use core\entities\Shop\Warehouse;
use core\forms\manage\Shop\Product\WarehousesProductForm;
use core\entities\Shop\DeliveryTerm;
use core\entities\Shop\ExtraStatus;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class WarehousesProduct
 * @package core\entities\Shop\Product
 * @property integer $id
 * @property integer $warehouse_id
 * @property integer $product_id
 * @property integer $extra_status_id
 * @property integer $delivery_term_id
 * @property integer $external_status
 * @property integer $price
 * @property integer $quantity
 * @property integer $special
 * @property integer $special_status
 * @property integer $special_start
 * @property integer $special_end
 * @property ExtraStatus $extraStatus
 * @property DeliveryTerm $deliveryTerm
 * @property Warehouse $warehouse
 * @property Product $product
 */
class WarehousesProduct extends ActiveRecord
{
    public static function create(
        $warehouseId,
        $productId,
        $extraStatusId,
        $deliveryTermId,
        $externalStatus,
        $price,
        $quantity,
        $special,
        $specialStatus,
        $specialStart,
        $specialEnd
    ): self
    {
        $warehousesProduct = new static();
        $warehousesProduct->warehouse_id = $warehouseId;
        $warehousesProduct->product_id = $productId;
        $warehousesProduct->extra_status_id = $extraStatusId;
        $warehousesProduct->delivery_term_id = $deliveryTermId;
        $warehousesProduct->external_status = $externalStatus;
        $warehousesProduct->price = $price;
        $warehousesProduct->quantity = $quantity;
        $warehousesProduct->special = $special;
        $warehousesProduct->special_status = $specialStatus;
        $warehousesProduct->special_start = strtotime($specialStart);
        $warehousesProduct->special_end = strtotime($specialEnd);

        return $warehousesProduct;
    }

    public function edit(
        $extraStatusId,
        $deliveryTermId,
        $externalStatus,
        $price,
        $quantity,
        $special,
        $specialStatus,
        $specialStart,
        $specialEnd
    ): void
    {
        $this->extra_status_id = $extraStatusId;
        $this->delivery_term_id = $deliveryTermId;
        $this->external_status = $externalStatus;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->special = $special;
        $this->special_status = $specialStatus;
        $this->special_start = strtotime($specialStart);
        $this->special_end = strtotime($specialEnd);
    }

    public function isIdEqualTo($id)
    {
        return $this->id == $id;
    }

    public function isSpecial(): ?bool
    {
        return $this->special_status && $this->special && $this->special_start < time() && ($this->special_end ? $this->special_end > time() : true);
    }

    public function getSpecialPercent()
    {
        $result = 0;
        if ($this->isSpecial()) {
            $result =  ($this->price - $this->special) / ($this->price / 100);
        }
        return $result;
    }


    //Relations
    public function getWarehouse(): ActiveQuery
    {
        return $this->hasOne(Warehouse::class, ['id' => 'warehouse_id']);
    }

    public function getExtraStatus(): ActiveQuery
    {
        return $this->hasOne(ExtraStatus::class, ['id' => 'extra_status_id']);
    }

    public function getDeliveryTerm(): ActiveQuery
    {
        return $this->hasOne(DeliveryTerm::class, ['id' => 'delivery_term_id']);
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_warehouses_products}}';
    }

    public static function find(): WarehousesProductQuery
    {
        return new WarehousesProductQuery(static::class);
    }

}