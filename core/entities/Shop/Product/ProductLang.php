<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.12.17
 * Time: 14:53
 */

namespace core\entities\Shop\Product;

use core\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;

class ProductLang extends ActiveRecord
{
    public $meta;

    public function behaviors()
    {
        return [
            MetaBehavior::class
        ];
    }

    public static function tableName()
    {
        return '{{%shop_products_lang}}';
    }

}