<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 13:17
 */

namespace core\entities\Shop\Category;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;
use paulzi\nestedsets\NestedSetsBehavior;
use core\entities\Shop\queries\CategoryQuery;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use core\entities\behaviors\FilledMultilingualBehavior;
use core\entities\Shop\Category\CategoryLang;

/**
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $title
 * @property string $description
 * @property Meta $meta
 * @property string $name_ua
 * @property string $title_ua
 * @property string $description_ua
 * @property Meta $meta_ua
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $image
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

    public static function create(array $names, array $titles, array $descriptions, array $metas, $slug): self
    {
        $category = new static();
        $category->slug = $slug;

        //$category->name, $category->name_ua...
        foreach ($names as $name => $value) {
            $category->{$name} = $value;
        }

        //$category->title, $category->title_ua...
        foreach ($titles as $name => $value) {
            $category->{$name} = $value;
        }

        //$category->description, $category->description_ua...
        foreach ($descriptions as $name => $value) {
            $category->{$name} = $value;
        }

        //$category->meta, $category->meta_ua...
        foreach ($metas as $name => $value) {
            $category->{$name} = $value;
        }

        return $category;
    }

    public function edit(array $names, array $titles, array $descriptions, array $metas, $slug): void
    {
        $this->slug = $slug;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->title, $this->title_ua...
        foreach ($titles as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->meta, $this->meta_ua...
        foreach ($metas as $name => $value) {
            $this->{$name} = $value;
        }
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
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => CategoryLang::className(),
                'langForeignKey' => 'category_id',
                'tableName' => '{{%shop_categories_lang}}',
                'attributes' => [
                    'name', 'title', 'description', 'meta'
                ]
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