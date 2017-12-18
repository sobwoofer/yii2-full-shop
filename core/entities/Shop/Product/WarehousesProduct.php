<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.12.17
 * Time: 10:56
 */

namespace core\entities\Shop\Product;


use core\entities\Shop\Warehouse;
use core\forms\manage\Shop\Product\WarehousesProductForm;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class WarehousesProduct
 * @package core\entities\Shop\Product
 * @property integer $id
 * @property integer $warehouse_id
 * @property integer $product_id
 * @property integer $extra_status_id
 * @property integer $external_status
 * @property integer $price
 * @property integer $quantity
 * @property integer $special
 * @property integer $special_status
 * @property integer $special_start
 * @property integer $special_end
 * @property ExtraStatus $extraStatus
 * @property Warehouse $warehouse
 * @property Product $product
 */
class WarehousesProduct extends ActiveRecord
{
    public static function create(
        $warehouseId,
        $productId,
        $extraStatusId,
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
        $warehousesProduct->external_status = $externalStatus;
        $warehousesProduct->price = $price;
        $warehousesProduct->quantity = $quantity;
        $warehousesProduct->special = $special;
        $warehousesProduct->special_status = $specialStatus;
        $warehousesProduct->special_start = $specialStart;
        $warehousesProduct->special_end = $specialEnd;

        return $warehousesProduct;
    }

    public function edit(
        $extraStatusId,
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
        $this->external_status = $externalStatus;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->special = $special;
        $this->special_status = $specialStatus;
        $this->special_start = $specialStart;
        $this->special_end = $specialEnd;
    }

    public function isIdEqualTo($id)
    {
        return $this->id == $id;
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

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_warehouses_products}}';
    }

}