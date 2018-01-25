<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.01.18
 * Time: 11:07
 */

namespace core\entities\Shop\PaymentMethod;


use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class PaymentToDeliveryAssignments
 * @package core\entities\Shop\PaymentMethod
 * @property integer $payment_id
 * @property integer $delivery_id
 */
class PaymentToDeliveryAssignments extends ActiveRecord
{

    public static function create($deliveryId): self
    {
        $assignment = new static();
        $assignment->delivery_id = $deliveryId;

        return $assignment;
    }

    public function isForDelivery($id): bool
    {
        return $this->delivery_id == $id;
    }

    public function getPayment(): ActiveQuery
    {
        return $this->hasOne(PaymentMethod::class, ['id' => 'payment_id']);

    }

    public function getPDelivery(): ActiveQuery
    {
        return $this->hasOne(DeliveryMethod::class, ['id' => 'delivery_id']);
    }

    public static function tableName(): string
    {
        return '{{%shop_payment_to_delivery_assignments}}';
    }

}