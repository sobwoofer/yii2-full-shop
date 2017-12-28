<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.09.17
 * Time: 11:45
 */

namespace core\forms\Shop;


use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Product\Product;
use core\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class AddToCartForm
 * @package core\forms\Shop
 * @property array $modifications
 * @property integer $quantity
 * @property Product $_product
 */
class AddToCartForm extends Model
{
    public $modifications;
    public $quantity;

    private $_product;

    public function __construct(Product $product, array $config = [])
    {
        $this->_product = $product;
        $this->quantity = 1;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([$this->_product->modifications ? ['modifications', 'each', 'rule' => ['integer']] : false,
            ['quantity', 'required'],
            ['quantity', 'integer', 'max' => $this->_product->warehousesProduct->quantity],
        ]);
    }


    public function getModificationDataAttributes(): ?array
    {
        foreach ($this->_product->modificationAssignments as $assignment) {
            $result[$assignment->modification->id] = [
                'data-price' => $assignment->modification->price,
                'data-min-qty' => $assignment->min_qty,
                'data-depend-qty' => $assignment->modification->group->depend_qty,
            ];
        }
        return $result ?? null;
    }

    public function modificationsList(): ?array
    {
        foreach ($this->_product->modificationAssignments as $assignment) {
                $result[$assignment->modification->group_id][] = $assignment;
        }
        return $result ?? null;
    }
}