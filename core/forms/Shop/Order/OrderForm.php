<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:34
 */

namespace core\forms\Shop\Order;

use core\entities\Shop\PaymentMethod\PaymentMethod;
use core\forms\CompositeForm;

/**
 * @property DeliveryForm $delivery
 * @property PaymentForm $payment
 * @property CustomerForm $customer
 */
class OrderForm extends CompositeForm
{
    public $note;

    public function __construct(int $weight, ?int $deliveryId, array $config = [])
    {
        $this->delivery = new DeliveryForm($weight);
        $this->payment = new PaymentForm($deliveryId);
        $this->customer = new CustomerForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['note'], 'string'],
        ];
    }

    protected function internalForms(): array
    {
        return ['delivery', 'customer'];
    }
}