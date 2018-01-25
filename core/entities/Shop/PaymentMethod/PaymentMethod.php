<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.01.18
 * Time: 12:43
 */

namespace core\entities\Shop\PaymentMethod;


use core\entities\behaviors\FilledMultilingualBehavior;
use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use core\entities\Shop\queries\PaymentMethodQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use omgdef\multilingual\MultilingualQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use core\entities\Shop\Warehouse;

/**
 * Class PaymentMethod
 * @package entities\Shop
 * @property integer $warehouse_id
 * @property integer $id
 * @property integer $active
 * @property float $max_cost
 * @property float $min_cost
 * @property string $name
 * @property string $name_ua
 * @property string $description
 * @property string $description_ua
 * @property Warehouse $warehouse
 * @property DeliveryMethod[] $deliveries
 * @property PaymentToDeliveryAssignments[] $toDeliveryAssignments
 */
class PaymentMethod extends ActiveRecord
{

    public static function create($warehouseId, $active, $names, $descriptions): self
    {
        $method = new static();
        $method->active = $active;
        $method->warehouse_id = $warehouseId;


        //$method->name, $method->name_ua...
        foreach ($names as $name => $value) {
            $method->{$name} = $value;
        }

        //$method->description, $method->$description_ua...
        foreach ($descriptions as $name => $value) {
            $method->{$name} = $value;
        }

        return $method;

    }

    public function edit($warehouseId, $active, $names, $descriptions): void
    {
        $this->warehouse_id = $warehouseId;
        $this->active = $active;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

    }

    public function getWarehouse(): ActiveQuery
    {
        return $this->hasOne(Warehouse::class, ['id' => 'warehouse_id']);
    }

    public function getToDeliveryAssignments()
    {
        return $this->hasMany(PaymentToDeliveryAssignments::class, ['payment_id' => 'id']);
    }

    public function getDeliveries()
    {
        return $this->hasMany(DeliveryMethod::class, ['id' => 'delivery_id'])->via('toDeliveryAssignments');
    }

//    private function updateDeliveryAssignments(array $deliveryAssignments): void
//    {
//        $this->toDeliveryAssignments = $deliveryAssignments;
//    }

    public function assignDelivery($id)
    {
        $assignments = $this->toDeliveryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForDelivery($id)) {
                return;
            }
        }

        $assignments[] = PaymentToDeliveryAssignments::create($id);
        $this->toDeliveryAssignments = $assignments;
    }

    public function revokeDelivery($id): void
    {
        $assignments = $this->toDeliveryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForDelivery($id)) {
                unset($assignments[$i]);
                $this->toDeliveryAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not fount');
    }

    public function revokeDeliveries(): void
    {
        $this->toDeliveryAssignments = [];
    }



    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [
                    'toDeliveryAssignments',
                ],
            ],
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'payment_method_id',
                'tableName' => '{{%shop_payment_methods_lang}}',
                'attributes' => [
                    'name', 'description'
                ]
            ],


        ];
    }

    public static function find(): PaymentMethodQuery
    {
        return new PaymentMethodQuery(static::class);
    }

    public static function tableName(): string
    {
        return '{{%shop_payment_methods}}';
    }

}