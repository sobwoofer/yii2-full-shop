<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.08.17
 * Time: 11:05
 */

namespace core\entities\Shop;

use core\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;
use core\entities\Meta;

/**
 * Class Brand
 * @package core\entities\Shop
 * @property integer $id
 * @property string $slug
 * @property Meta $meta
 * @property string $name
 */
class Brand extends ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta): self
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    ##########################

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
        ];
    }

}