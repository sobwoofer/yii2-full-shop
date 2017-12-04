<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 10.11.17
 * Time: 10:32
 */

namespace core\entities\Blog\Post;


use core\entities\Blog\Post\queries\PostQuery;
use core\entities\Meta;
use yii\db\ActiveRecord;
use core\entities\behaviors\MetaBehavior;

/**
 * Class PostLang
 * @package core\entities\Blog\Post
 * @property Meta $meta
 */
class PostLang extends ActiveRecord
{
    public $meta;

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
        ];
    }

    public static function tableName()
    {
        return '{{%blog_posts_lang}}';
    }
}