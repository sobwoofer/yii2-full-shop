<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.01.18
 * Time: 16:23
 */

namespace core\forms\manage\Shop\Order;


use core\entities\Shop\Order\Order;
use core\entities\Shop\PaymentMethod\PaymentMethod;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class PaymentForm extends Model
{
    public $method;

    private $_order;

    public function __construct(Order $order, array $config = [])
    {
        $this->method = $order->delivery_method_id;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
        ];
    }

    public function paymentMethodsList(): array
    {
        $methods = PaymentMethod::find()->all();

        return ArrayHelper::map($methods, 'id', function (PaymentMethod $method) {
            return $method->name;
        });
    }

}