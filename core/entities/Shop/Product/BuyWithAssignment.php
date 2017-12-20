<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.12.17
 * Time: 12:04
 */

namespace core\entities\Shop\Product;


use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Class Relatives
 * @package core\entities\Shop\Product
 * @property integer $product_id
 * @property integer $related_id
 * @property Product $buyWithProduct;
 */
class BuyWithAssignment extends ActiveRecord
{
    public static function create($productId): self
    {
        $assignment = new static();
        $assignment->related_id = $productId;
        return $assignment;
    }

    public function getBuyWithProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'related_id']);
    }

    public function isForProduct($id): bool
    {
        return $this->related_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_buy_with_assignments}}';
    }

}