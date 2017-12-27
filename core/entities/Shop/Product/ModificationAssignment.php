<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 13:28
 */

namespace core\entities\Shop\Product;


use core\entities\Shop\Modification\Modification;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class ModificationAssignment
 * @package core\entities\Shop\Product
 * @property integer $product_id
 * @property integer $modification_id
 * @property integer $min_qty
 * @property integer $status
 * @property Product $product
 * @property Modification $modification
 */
class ModificationAssignment extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    public static function create($modificationId, $minQty, $status): self
    {
        $assignment = new static();
        $assignment->modification_id = $modificationId;
        $assignment->status = $status;
        $assignment->min_qty = $minQty;

        return $assignment;
    }

    public function edit($minQty, $status): void
    {
        $this->min_qty = $minQty;
        $this->status = $status;
    }

    public function isForModification($id): bool
    {
        return $this->modification_id == $id;
    }

    public function getModification(): ActiveQuery
    {
        return $this->hasOne(Modification::class, ['id' => 'modification_id']);

    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_modification_assignments}}';
    }

}