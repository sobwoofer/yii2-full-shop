<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:44
 */

namespace core\entities\Shop;


use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * this entity describes real stores of company when sale productions
 * Class Store
 * @package core\entities\Shop
 * @property integer $id
 * @property integer $city_id
 * @property string $phone
 * @property string $email
 * @property string $work_weekdays
 * @property string $work_weekend
 * @property string $photo
 * @property string $slug
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $name_ua
 * @property string $address_ua
 * @property string $description_ua
 */
class Store extends ActiveRecord
{
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_stores}}';
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'store_id',
                'tableName' => '{{%shop_stores_lang}}',
                'attributes' => [
                    'name', 'address', 'description'
                ]
            ],
        ];
    }

}