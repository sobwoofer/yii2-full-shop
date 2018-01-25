<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.01.18
 * Time: 12:43
 */

namespace core\entities\Shop;


use core\entities\behaviors\FilledMultilingualBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use omgdef\multilingual\MultilingualQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 */
class PaymentMethod extends ActiveRecord
{

    public static function create($warehouseId, $active, $max_cost, $min_cost, $names, $descriptions): self
    {
        $method = new static();
        $method->active = $active;
        $method->warehouse_id = $warehouseId;
        $method->max_cost = $max_cost;
        $method->min_cost = $min_cost;

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

    public function edit($warehouseId, $active, $max_cost, $min_cost, $names, $descriptions): void
    {
        $this->warehouse_id = $warehouseId;
        $this->max_cost = $max_cost;
        $this->min_cost = $min_cost;

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

    public function behaviors(): array
    {
        return [
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

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_payment_methods}}';
    }

}