<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.12.17
 * Time: 12:41
 */

namespace core\entities\Geo;


use omgdef\multilingual\MultilingualQuery;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * Class City
 * @package core\entities\Geo
 * @property integer $id
 * @property integer $region_id
 * @property string $iso_code
 * @property integer $sort
 * @property string $name
 * @property string $name_ua
 */
class City extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%geo_cities}}';
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'city_id',
                'tableName' => '{{%geo_cities_lang}}',
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }

}