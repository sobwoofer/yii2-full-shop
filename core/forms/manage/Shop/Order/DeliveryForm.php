<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.09.17
 * Time: 16:24
 */

namespace core\forms\manage\Shop\Order;

use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use core\entities\Shop\Order\Order;
use core\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeliveryForm extends Model
{
    public $method;
    public $address;

    private $_order;

    public function __construct(Order $order, array $config = [])
    {
        $this->method = $order->delivery_method_id;
        $this->address = $order->deliveryData->address;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
            [['address'], 'required'],
            [['address'], 'string'],
        ];
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->orderBy('sort')->all();

        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            return $method->name . ' (' . PriceHelper::format($method->cost) . ')';
        });
    }
}