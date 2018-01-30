<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:33
 */

namespace core\forms\Shop\Order;

use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use core\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeliveryForm extends Model
{
    public $method;

    private $_weight;

    public function __construct(int $weight, array $config = [])
    {
        $this->_weight = $weight;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
        ];
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->availableForWeight($this->_weight)->orderBy('sort')->all();

        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            return $method->name . ' (' . PriceHelper::format($method->cost) . ')';
        });
    }
}