<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.12.17
 * Time: 17:50
 */

namespace core\entities\Shop\Category;


use core\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;

class CategoryLang extends ActiveRecord
{
    public $meta;

    public function behaviors()
    {
        return [
            MetaBehavior::className(),
        ];
    }

    public static function tableName()
    {
        return '{{%shop_categories_lang}}';
    }

}