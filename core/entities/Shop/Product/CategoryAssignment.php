<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 16.08.17
 * Time: 14:17
 */

namespace core\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class CategoryAssignment
 * @package core\entities\Shop\Product
 * @property integer $product_id;
 * @property integer $category_id;
 */
class CategoryAssignment extends ActiveRecord
{
    public static function create($categoryId): self
    {
        $assignment = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    public function isForCategory($id): bool
    {
        return $this->category_id == $id;
    }

    public static function tableName()
    {
        return '{{%shop_category_assignments}}';
    }
}