<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.09.17
 * Time: 16:24
 */

namespace core\forms\manage\Shop\Order;

use core\entities\Shop\Order\Order;
use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $email;
    public $firstName;
    public $lastName;

    public function __construct(Order $order, array $config = [])
    {
        $this->phone = $order->customerData->phone;
        $this->firstName = $order->customerData->firstName;
        $this->lastName = $order->customerData->lastName;
        $this->email = $order->customerData->email;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'firstName', 'email'], 'required'],
            ['email', 'email'],
            [['phone', 'firstName', 'lastName'], 'string', 'max' => 255],
        ];
    }
}