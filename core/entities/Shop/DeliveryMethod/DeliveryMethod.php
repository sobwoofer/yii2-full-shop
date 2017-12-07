<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:14
 */

namespace core\entities\Shop\DeliveryMethod;

use core\entities\Shop\queries\DeliveryMethodQuery;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * @property int $id
 * @property string $name
 * @property int $cost
 * @property int $min_weight
 * @property int $max_weight
 * @property int $sort
 */
class DeliveryMethod extends ActiveRecord
{
    public static function create(array $names, array $descriptions, $cost, $minWeight, $maxWeight, $sort): self
    {
        $method = new static();

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $method->{$name} = $value;
        }

        //$this->description, $this->description_ua...
        foreach ($descriptions as $name => $value) {
            $method->{$name} = $value;
        }

        $method->cost = $cost;
        $method->min_weight = $minWeight;
        $method->max_weight = $maxWeight;
        $method->sort = $sort;
        return $method;
    }

    public function edit(array $names, array $descriptions, $cost, $minWeight, $maxWeight, $sort): void
    {
        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

        $this->cost = $cost;
        $this->min_weight = $minWeight;
        $this->max_weight = $maxWeight;
        $this->sort = $sort;
    }

    public function isAvailableForWeight($weight): bool
    {
        return (!$this->min_weight || $this->min_weight <= $weight) && (!$this->max_weight || $weight <= $this->max_weight);
    }

    public static function tableName(): string
    {
        return '{{%shop_delivery_methods}}';
    }

    public static function find(): DeliveryMethodQuery
    {
        return new DeliveryMethodQuery(static::class);
    }



    public function behaviors()
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => DeliveryMethodLang::className(),
                'langForeignKey' => 'delivery_method_id',
                'tableName' => '{{%shop_delivery_methods_lang}}',
                'attributes' => [
                    'name', 'description'
                ]
            ],
        ];
    }
}