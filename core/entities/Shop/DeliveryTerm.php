<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.12.17
 * Time: 16:40
 */

namespace core\entities\Shop;


use core\entities\behaviors\FilledMultilingualBehavior;
use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;

/**
 * Class DeliveryTerm
 * @package entities\Shop\Product
 * @property integer $id
 * @property integer $external_id
 * @property string $slug
 * @property string $name
 * @property string $name_ua
 */
class DeliveryTerm extends ActiveRecord
{
    public static function create($externalId, $slug, $names): self
    {
        $deliveryTerm = new static();
        $deliveryTerm->external_id = $externalId;
        $deliveryTerm->slug = $slug;

        //$deliveryTerm->name, $deliveryTerm->name_ua...
        foreach ($names as $name => $value) {
            $deliveryTerm->{$name} = $value;
        }

        return $deliveryTerm;
    }

    public function edit($externalId, $slug, $names): void
    {
        $this->external_id = $externalId;
        $this->slug = $slug;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

    }

    public static function tableName()
    {
        return '{{%shop_delivery_terms}}';
    }


    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'delivery_term_id',
                'tableName' => '{{%shop_delivery_terms_lang}}',
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }


}