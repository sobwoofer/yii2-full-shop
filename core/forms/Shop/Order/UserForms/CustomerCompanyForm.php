<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.01.18
 * Time: 15:36
 */

namespace forms\Shop\Order\UserForms;


use core\entities\User\User;
use yii\base\Model;

class CustomerCompanyForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;
    public $address;
    public $phone;
    public $companyName;
    public $companyTaxCode;

    public function __construct(User $user, array $config = [])
    {
        if ($user) {
            $this->firstName = $user->userCompany->first_name;
            $this->lastName = $user->userCompany->last_name;
            $this->email = $user->email;
            $this->address = $user->userCompany->address;
            $this->companyName = $user->userCompany->company_name;
            $this->companyTaxCode = $user->userCompany->company_tax_code;
            $this->phone = $user->phone;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['firstName', 'phone', 'lastName', 'email', 'address', 'companyName', 'companyTaxCode'], 'required'],
            ['email', 'email'],
            [['phone', 'firstName', 'address', 'lastName', 'companyName', 'companyTaxCode'], 'string', 'max' => 255],
        ];
    }

}