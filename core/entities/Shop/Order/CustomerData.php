<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:06
 */

namespace core\entities\Shop\Order;

class CustomerData
{
    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public function __construct($firstName, $lastName, $email, $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }
}