<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.08.17
 * Time: 11:05
 */

namespace shop\entities\Shop;


use yii\db\ActiveRecord;
use yii\helpers\Json;

class Brand extends ActiveRecord
{
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

    ##########################

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function beforeSave($insert): bool
    {
        $this->setAttribute('meta_json', Json::encode([
            'title' => $this->meta->title,
            'description' => $this->meta->description,
            'keywords' => $this->meta->keywords,
        ]));
        return parent::beforeSave($insert);
    }

}