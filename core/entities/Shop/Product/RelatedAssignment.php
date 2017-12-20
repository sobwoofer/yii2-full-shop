<?php

namespace core\entities\Shop\Product;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $product_id;
 * @property integer $related_id;
 * @property Product $relatedProduct;
 */
class RelatedAssignment extends ActiveRecord
{
    public static function create($productId): self
    {
        $assignment = new static();
        $assignment->related_id = $productId;
        return $assignment;
    }

    public function isForProduct($id): bool
    {
        return $this->related_id == $id;
    }

    public function getRelatedProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'related_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_related_assignments}}';
    }
}