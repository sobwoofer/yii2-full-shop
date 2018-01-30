<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.01.18
 * Time: 16:26
 */

namespace forms\Shop\Order\UserForms;


use core\entities\User\User;
use yii\base\Model;

class CustomerSimpleForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;
    public $address;
    public $phone;

    public function __construct(User $user, array $config = [])
    {
        if ($user) {
            $this->firstName = $user->username;
            $this->lastName = null;
            $this->email = $user->email;
            $this->address = null;
            $this->phone = $user->phone;
        }
        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['firstName', 'phone', 'email'], 'required'],
            ['email', 'email'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

}