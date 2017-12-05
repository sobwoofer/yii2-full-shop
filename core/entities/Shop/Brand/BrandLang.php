<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.12.17
 * Time: 15:08
 */

namespace core\entities\Shop\Brand;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class BrandLang
 * @package entities\Shop\Brand
 * @property Meta $meta
 */
class BrandLang extends ActiveRecord
{
    public $meta;

    public function behaviors()
    {
        return [
            MetaBehavior::className()
        ];
    }

    public static function tableName()
    {
        return '{{%shop_brands_lang}}';
    }


}