<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.09.17
 * Time: 16:25
 */


namespace core\forms\manage\Shop\Order;

use core\entities\Shop\Order\Order;
use core\forms\CompositeForm;

/**
 * @property DeliveryForm $delivery
 * @property CustomerForm $customer
 * @property PaymentForm $payment
 */
class OrderEditForm extends CompositeForm
{
    public $note;

    public function __construct(Order $order, array $config = [])
    {
        $this->note = $order->note;
        $this->customer = new CustomerForm($order);
        $this->delivery = new DeliveryForm($order);
        $this->payment = new PaymentForm($order);
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
        return ['delivery', 'customer', 'payment'];
    }
}