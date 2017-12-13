<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:41
 */

namespace core\entities\Shop;


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
 * @property string $description
 * @property string $description_ua
 */
class GivePoint extends ActiveRecord
{
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