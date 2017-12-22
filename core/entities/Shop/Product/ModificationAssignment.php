<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 13:28
 */

namespace core\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class ModificationAssignment
 * @package core\entities\Shop\Product
 * @property integer $product_id
 * @property integer $modification_id
 * @property integer $min_qty
 * @property integer $status
 */
class ModificationAssignment extends ActiveRecord
{
    public static function create($modificationId, $minQty, $status): self
    {
        $assignment = new static();
        $assignment->modification_id = $modificationId;
        $assignment->status = $status;
        $assignment->min_qty = $minQty;

        return $assignment;
    }

    public function edit($status): void
    {
        $this->status = $status;
    }

    public static function tableName(): string
    {
        return '{{%shop_modification_assignments}}';
    }

}