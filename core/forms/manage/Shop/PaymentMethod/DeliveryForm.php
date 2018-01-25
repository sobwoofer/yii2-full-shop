<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.01.18
 * Time: 12:13
 */

namespace core\forms\manage\Shop\PaymentMethod;


use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use core\entities\Shop\PaymentMethod\PaymentMethod;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class DeliveryForm
 * @package forms\manage\Shop\PaymentMethod
 * @property array $deliveries;
 */
class DeliveryForm extends Model
{
    public $deliveries;

    public function __construct(PaymentMethod $paymentMethod = null, $config = [])
    {
        if ($paymentMethod) {
            $this->deliveries = ArrayHelper::getColumn($paymentMethod->toDeliveryAssignments, 'delivery_id');
        }
        parent::__construct($config);
    }

    public function deliveryList(): array
    {
        return ArrayHelper::map(DeliveryMethod::find()->localized()->asArray()->all(), 'id', function (array $deliveryMethod) {
            return  $deliveryMethod['translation']['name'];
        });
    }

    public function rules(): array
    {
        return [
            [['deliveries'], 'each', 'rule' => ['integer']],
        ];
    }
}