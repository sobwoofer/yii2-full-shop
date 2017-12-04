<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.12.17
 * Time: 10:53
 */

namespace core\entities\Blog;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class CategoryLang
 * @package core\entities\Blog
 * @property Meta $meta
 */
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
        return '{{%blog_categories_lang}}';
    }


}