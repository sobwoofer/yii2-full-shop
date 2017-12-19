<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.12.17
 * Time: 16:40
 */

namespace core\entities\Shop\Product;


use core\entities\behaviors\FilledMultilingualBehavior;
use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;

/**
 * Class DeliveryTerm
 * @package entities\Shop\Product
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $name_ua
 */
class DeliveryTerm extends ActiveRecord
{
    public static function create(): self
    {
        $deliveryTerm = new static();

        return $deliveryTerm;
    }

    public function edit(): void
    {

    }

    public static function tableName()
    {
        return '{{%shop_product_delivery_terms}}';
    }


    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'delivery_term_id',
                'tableName' => '{{%shop_product_delivery_terms_lang}}',
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