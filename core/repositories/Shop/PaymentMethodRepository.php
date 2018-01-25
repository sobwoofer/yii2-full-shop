<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.01.18
 * Time: 16:04
 */

namespace core\repositories\Shop;


use core\entities\Shop\PaymentMethod\PaymentMethod;
use core\repositories\NotFoundException;

class PaymentMethodRepository
{
    public function get($id): PaymentMethod
    {
        if (!$method = PaymentMethod::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Payment Method is not found.');
        }
        return $method;
    }

    public function findByName($name): ?PaymentMethod
    {
        return PaymentMethod::findOne(['name' => $name]);
    }

    public function save(PaymentMethod $method): void
    {
        if (!$method->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(PaymentMethod $method): void
    {
        if (!$method->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}