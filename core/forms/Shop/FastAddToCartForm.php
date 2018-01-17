<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.01.18
 * Time: 13:48
 */

namespace core\forms\Shop;


use yii\base\Model;

class FastAddToCartForm extends Model
{
    public $code;
    public $quantity;

    public function __construct(array $config = [])
    {
        $this->quantity = 1;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['code', 'required'],
            ['quantity', 'required'],
            ['code', 'string'],
            ['quantity', 'integer'],
        ];
    }

}