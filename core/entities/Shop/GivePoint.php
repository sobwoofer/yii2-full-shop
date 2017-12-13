<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:41
 */

namespace core\entities\Shop;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * this entity describes table where storage all points where buyer can get product after order in online shop
 * Class GivePoint
 * @package core\entities\Shop
 * @property integer $id
 * @property integer $warehouse_id
 * @property integer $store_id
 * @property string $slug
 * @property string $name
 * @property string $name_ua
 * @property string $description
 * @property string $description_ua
 */
class GivePoint extends ActiveRecord
{
    public static function create($warehouseId, $storeId, $slug, array $names, array $descriptions): self
    {
        $givePoint = new static();
        $givePoint->warehouse_id = $warehouseId;
        $givePoint->store_id = $storeId;
        $givePoint->slug = $slug;

        //$givePoint->name, $givePoint->name_ua...
        foreach ($names as $name => $value) {
            $givePoint->{$name} = $value;
        }

        //$givePoint->description, $givePoint->$description_ua...
        foreach ($descriptions as $name => $value) {
            $givePoint->{$name} = $value;
        }

        return $givePoint;
    }

    public function edit($warehouseId, $storeId, $slug, array $names, array $descriptions): void
    {
        $this->warehouse_id = $warehouseId;
        $this->store_id = $storeId;
        $this->slug = $slug;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

    }

    //Relations

    public function getWarehouse(): ActiveQuery
    {
        return $this->hasOne(Warehouse::class, ['id' => 'warehouse_id']);
    }

    public function getStore(): ActiveQuery
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_give_points}}';
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'give_point_id',
                'tableName' => '{{%shop_give_points_lang}}',
                'attributes' => [
                    'name', 'description'
                ]
            ],
        ];
    }

}