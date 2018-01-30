<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:34
 */

namespace core\forms\Shop\Order;

use core\entities\Shop\PaymentMethod\PaymentMethod;
use core\entities\User\User;
use core\forms\CompositeForm;
use core\forms\Shop\Order\UserForms\CustomerForm;
use forms\Shop\Order\UserForms\CustomerCompanyForm;
use forms\Shop\Order\UserForms\CustomerSimpleForm;
use Yii;

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
        if ($user = $this->getUser()) {
            switch ($user->type){
                case $user::TYPE_INDIVIDUAL :
                    $this->customer = new CustomerForm($user);
                    break;
                case $user::TYPE_COMPANY :
                    $this->customer = new CustomerCompanyForm($user);
                    break;
                case $user::TYPE_ADMIN :
                    $this->customer = new CustomerSimpleForm($user);
                    break;
            }
        } else {
            $this->customer = new CustomerForm();
        }
        parent::__construct($config);
    }

    public function getUser(): ?User
    {
        return User::findOne(Yii::$app->user->id);
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