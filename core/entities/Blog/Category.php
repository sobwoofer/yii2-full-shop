<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.09.17
 * Time: 12:11
 */

namespace core\entities\Blog;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class Category
 * @package core\entities\Blog
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $sort
 * @property Meta $meta
 */
class Category extends ActiveRecord
{

    public $meta;

    public static function create($name, $slug, $title, $description, $sort, Meta $meta): self
    {
        $category = new static();
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->sort = $sort;
        $category->meta = $meta;
        return $category;
    }

    public function edit($name, $slug, $title, $description, $sort, Meta $meta):void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->sort = $sort;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTitle();
    }

    public function getHeadingTitle(): string
    {
        return $this->title ?: $this->getHeadingTitle();
    }

    public static function tableName(): string
    {
        return '{{%blog_categories}}';
    }

    public function behaviors()
    {
        return [
            MetaBehavior::className(),
        ];
    }

}