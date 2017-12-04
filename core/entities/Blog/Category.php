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
use core\entities\Blog\CategoryLang;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * Class Category
 * @package core\entities\Blog
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $name
 * @property string $description
 * @property string $title_ua
 * @property string $name_ua
 * @property string $description_ua
 * @property integer $sort
 * @property Meta $meta
 * @property Meta $meta_ua
 */
class Category extends ActiveRecord
{

    public static function create($slug, $sort, array $names, array $titles, array $descriptions, array $metas): self
    {
        $category = new static();
        $category->slug = $slug;
        $category->sort = $sort;

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

    public function edit($slug, $sort, array $names, array $titles, array $descriptions, array $metas):void
    {
        $this->slug = $slug;
        $this->sort = $sort;

        //$category->name, $category->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$category->title, $category->title_ua...
        foreach ($titles as $name => $value) {
            $this->{$name} = $value;
        }

        //$category->description, $category->description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

        //$category->meta, $category->meta_ua...
        foreach ($metas as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTitle();
    }

    public function getHeadingTitle(): string
    {
        return $this->title ?: $this->name;
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => CategoryLang::className(), // or namespace/for/a/class/CategoryLang
                'langForeignKey' => 'category_id',
                'tableName' => '{{%blog_categories_lang}}',
                'attributes' => [
                    'name', 'title', 'description', 'meta'
                ]
            ],
        ];
    }


    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }


    public static function tableName(): string
    {
        return '{{%blog_categories}}';
    }

}