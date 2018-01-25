<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.01.18
 * Time: 14:49
 */

namespace core\forms\Shop\Order;


use core\entities\Shop\PaymentMethod\PaymentMethod;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class PaymentForm extends Model
{
    public $method;

    private $_deliveryId;

    public function __construct(?int $deliveryId, array $config = [])
    {
        $this->_deliveryId = $deliveryId;
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
        $methods = PaymentMethod::find()->available($this->_deliveryId)->all();

        return ArrayHelper::map($methods, 'id', function (PaymentMethod $method) {
            return $method->name;
        });
    }

}