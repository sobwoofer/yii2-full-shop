<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.12.17
 * Time: 17:37
 */

namespace core\forms\manage\Shop\Product;



use core\entities\Shop\Product\WarehousesProduct;
use core\entities\Shop\Warehouse;
use yii\base\Model;
use core\entities\Shop\Product\Product;

/**
 * Class WarehousesProductForm
 * @package core\forms\manage\Shop\Product
 * @property integer $externalStatus
 * @property integer $extraStatusId
 * @property integer $price
 * @property integer $quantity
 * @property integer $special
 * @property integer $specialStatus
 * @property integer $specialStart
 * @property integer $specialEnd
 * @property WarehousesProduct $_warehousesProduct
 */
class WarehousesProductForm extends Model
{
    public $externalStatus;
    public $extraStatusId;
    public $price;
    public $quantity;
    public $special;
    public $specialStatus;
    public $specialStart;
    public $specialEnd;

    public $id;
    public $warehouseName;
    private $warehouseId;

    public $_warehousesProduct;

    public function __construct(WarehousesProduct $warehousesProduct = null, $config = [])
    {
        if ($warehousesProduct) {
            $this->externalStatus = $warehousesProduct->external_status;
            $this->extraStatusId = $warehousesProduct->extra_status_id;
            $this->price = $warehousesProduct->price;
            $this->quantity = $warehousesProduct->quantity;
            $this->special = $warehousesProduct->special;
            $this->specialStatus = $warehousesProduct->special_status;
            $this->specialStart = $warehousesProduct->special_start;

            $this->id = $warehousesProduct->id;
            $this->warehouseId = $warehousesProduct->warehouse->id;
            $this->warehouseName = $warehousesProduct->warehouse->name;
            $this->_warehousesProduct = $warehousesProduct;
        }

        parent::__construct($config);
    }

    public function warehouseList()
    {
        return Warehouse::find()->localized()->all();
    }

    public function setWarehouseId($id): void
    {
        $this->warehouseId = $id;
    }

    public function setWarehouseName($id): void
    {
        $this->warehouseName = $id;
    }

    public function getWarehouseName()
    {
        return $this->warehouseName;
    }

    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }

    public function rules(): array
    {
        return [
            [['externalStatus', 'extraStatusId', 'price'], 'required'],
            [['price', 'special'], 'string'],
            [['externalStatus', 'quantity',  'extraStatusId', 'specialStatus', 'specialStart', 'specialEnd'], 'integer'],

        ];
    }

}