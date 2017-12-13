<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.12.17
 * Time: 12:39
 */

namespace core\entities\Geo;

use omgdef\multilingual\MultilingualQuery;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;
use yii\db\ActiveQuery;

/**
 * Class Region
 * @package core\entities\Geo
 * @property integer $id
 * @property string $iso_code
 * @property integer $sort
 * @property string $name
 * @property string $name_ua
 */
class Region extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%geo_regions}}';
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    //Relations

    public function getCountry(): ActiveQuery
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    public function getCities(): ActiveQuery
    {
        return $this->hasMany(City::class, ['region_id' => 'id']);
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'region_id',
                'tableName' => '{{%geo_regions_lang}}',
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }

}