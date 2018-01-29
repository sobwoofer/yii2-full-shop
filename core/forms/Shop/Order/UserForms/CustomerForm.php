<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.09.17
 * Time: 17:22
 */

namespace core\forms\Shop\Order\UserForms;

use core\entities\User\User;
use yii\base\Model;

class CustomerForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;
    public $address;
    public $phone;

    public function __construct(User $user = null, array $config = [])
    {
        if ($user) {
            $this->firstName = $user->userIndividual->first_name;
            $this->lastName = $user->userIndividual->last_name;
            $this->email = $user->email;
            $this->address = $user->userIndividual->address;
            $this->phone = $user->phone;
        }
        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['firstName','phone', 'email', 'address'], 'required'],
            ['email', 'email'],
            [['phone', 'firstName', 'address', 'firstName', 'lastName'], 'string', 'max' => 255],
        ];
    }
}