<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:22
 */

namespace core\forms\Shop\Order;

use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;

    public function rules(): array
    {
        return [
            [['phone', 'name'], 'required'],
            [['phone', 'name'], 'string', 'max' => 255],
        ];
    }
}