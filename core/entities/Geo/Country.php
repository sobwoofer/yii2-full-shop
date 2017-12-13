<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.12.17
 * Time: 10:22
 */

namespace core\entities\Geo;

use omgdef\multilingual\MultilingualQuery;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * Class Country
 * @package core\entities\Geo
 * @property integer $id
 * @property integer $lang_id
 * @property string $name_iso
 * @property string $a2_iso
 * @property string $a3_iso
 * @property integer $number_iso
 * @property string $name
 * @property string $name_ua
 */
class Country extends ActiveRecord
{

    public static function tableName(): string
    {
        return '{{%geo_countries}}';
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
                'langForeignKey' => 'country_id',
                'tableName' => '{{%geo_countries_lang}}',
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }

}