<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 13:17
 */

namespace core\entities\Shop;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;
use paulzi\nestedsets\NestedSetsBehavior;
use core\entities\Shop\queries\CategoryQuery;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $image
 * @property Meta $meta
 * @property Category[] $children
 *
 * @property Category $prev
 * @property Category $next
 * @property Category $parent
 * @property Category[] $parents
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, $title, $description, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;
        return $category;
    }

    public function edit($name, $slug, $title, $description, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }

    public function setPhoto(UploadedFile $image): void
    {
        $this->image = $image;
    }

    public static function tableName(): string
    {
        return '{{%shop_categories}}';
    }

    public function behaviors()
    {
        return [
            MetaBehavior::className(),
            NestedSetsBehavior::className(),
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/category/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/category/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/category/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/category/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'catalog' => ['width' => 151, 'height' => 122],
                    'thumb' => ['width' => 150, 'height' => 150],
                    'thumb_list' => ['width' => 30, 'height' => 30],
                ],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }

}