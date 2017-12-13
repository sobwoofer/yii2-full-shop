<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.08.17
 * Time: 11:05
 */

namespace core\entities\Shop\Brand;

use core\entities\behaviors\MetaBehavior;
use core\entities\Shop\Brand\BrandLang;
use yii\db\ActiveRecord;
use core\entities\Meta;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\web\UploadedFile;
use omgdef\multilingual\MultilingualQuery;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * Class Brand
 * @package core\entities\Shop
 * @property integer $id
 * @property string $slug
 * @property Meta $meta
 * @property string $name
 * @property string $image
 *
 * @mixin ImageUploadBehavior
 */
class Brand extends ActiveRecord
{
//    public $meta;

    public static function create(array $names, array $descriptions, array $metas, $slug): self
    {
        $brand = new static();
        //$this->$name, $this->$name_ua...
        foreach ($names as $name => $value) {
            $brand->{$name} = $value;
        }

        //$this->$description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $brand->{$name} = $value;
        }

        //$this->$meta, $this->$meta_ua...
        foreach ($metas as $name => $value) {
            $brand->{$name} = $value;
        }
        $brand->slug = $slug;
        return $brand;
    }

    public function edit(array $names, array $descriptions, array $metas, $slug): void
    {

        //$this->$name, $this->$name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->$description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->$meta, $this->$meta_ua...
        foreach ($metas as $name => $value) {
            $this->{$name} = $value;
        }

        $this->slug = $slug;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public function setPhoto(UploadedFile $image): void
    {
        $this->image = $image;
    }

    ##########################

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/brands/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/brands/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/brands/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/brands/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'home' => ['width' => 232, 'height' => 100],
                    'product_page' => ['width' => 170, 'height' => 27],
                ],
            ],
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => BrandLang::className(),
                'langForeignKey' => 'brand_id',
                'tableName' => '{{%shop_brands_lang}}',
                'attributes' => [
                    'name', 'description', 'meta'
                ]
            ],

        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

}