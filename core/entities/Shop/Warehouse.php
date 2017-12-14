<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:15
 */

namespace core\entities\Shop;


use core\entities\Geo\City;
use core\helpers\LangsHelper;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * Class Warehouse
 * @package core\entities\Shop
 * @property integer $id
 * @property integer $city_id
 * @property float $min_order
 * @property integer $default
 * @property string $slug
 * @property string $name
 * @property string $name_ua
 * @property string $address
 * @property string $address_ua
 * @property string $description
 * @property string $description_ua
 */
class Warehouse extends ActiveRecord
{
    public static function create($cityId, $minOrder, $slug, $default, array $names, array $addresses, array $descriptions): self
    {
        $warehouse = new static();
        $warehouse->city_id = $cityId;
        $warehouse->min_order = $minOrder;
        $warehouse->slug = $slug;
        $warehouse->default = $default;

        //$warehouse->name, $warehouse->name_ua...
        foreach ($names as $name => $value) {
            $warehouse->{$name} = $value;
        }

        //$warehouse->address, $warehouse->address_ua...
        foreach ($addresses as $name => $value) {
            $warehouse->{$name} = $value;
        }

        //$warehouse->description, $warehouse->$description_ua...
        foreach ($descriptions as $name => $value) {
            $warehouse->{$name} = $value;
        }

        return $warehouse;
    }

    public function edit($cityId, $minOrder, $slug, $default, array $names, array $addresses, array $descriptions): void
    {
        $this->city_id = $cityId;
        $this->min_order = $minOrder;
        $this->slug = $slug;
        $this->default = $default;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->address, $this->address_ua...
        foreach ($addresses as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

    }

    //Relations

    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_warehouses}}';
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'warehouse_id',
                'tableName' => '{{%shop_warehouses_lang}}',
                'attributes' => [
                    'name', 'address', 'description'
                ]
            ],
        ];
    }

}