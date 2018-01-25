<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.01.18
 * Time: 14:33
 */

namespace core\readModels\Shop;


use core\entities\Shop\PaymentMethod\PaymentMethod;

class PaymentMethodReadRepository
{


    public function getAllActive(): array
    {
        return PaymentMethod::find()->andWhere(['active' => true])->all();
    }





}