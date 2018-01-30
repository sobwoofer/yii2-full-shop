<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:09
 */

namespace core\entities\Shop\Order;

use core\entities\behaviors\OrderItemBehavior;
use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Product\ModificationAssignment;
use core\entities\Shop\Product\Product;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use core\entities\Shop\Order\ModificationWrapper;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property ModificationWrapper[] $modifications
 * @property string $product_name
 * @property string $product_code
 * @property float $price
 * @property float $price_old
 * @property int $quantity
 * @property Product $product
 */
class OrderItem extends ActiveRecord
{
    public $modifications = [];

    /**
     * @param Product $product
     * @param ModificationWrapper[] $modifications
     * @param $price
     * @param $priceOld
     * @param $quantity
     * @return static
     */
    public static function create(Product $product, array $modifications, $priceOld, $price, $quantity)
    {
        $item = new static();
        $item->product_id = $product->id;
        $item->product_name = $product->name;
        $item->product_code = $product->code;
        $item->modifications = $modifications;
        $item->price = $price;
        $item->price_old = $priceOld;
        $item->quantity = $quantity;
        return $item;
    }

    public function getCost(): int
    {
        return $this->price * $this->quantity;
    }

    public function getFullCost(): int
    {
        return $this->price * $this->quantity + $this->getModificationCost();
    }

    public function getModificationCost()
    {
        $cost = 0;
        if ($this->modifications) {
            foreach ($this->modifications as $modification) {
                $cost += $modification->cost;
            }
        }
        return $cost;
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function behaviors()
    {
        return [
            OrderItemBehavior::class
        ];
    }

    public static function tableName(): string
    {
        return '{{%shop_order_items}}';
    }
}