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

class City extends ActiveRecord
{
    public static function tableName()
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