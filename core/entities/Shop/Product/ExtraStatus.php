<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.12.17
 * Time: 17:15
 */

namespace core\entities\Shop\Product;


use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * Class ExtraStatus
 * @package core\entities\Shop\Product
 * @property integer $id
 * @property integer $external_id
 * @property string $slug
 * @property string $name
 * @property string $name_ua
 */
class ExtraStatus extends ActiveRecord
{

    public static function create(): self
    {
        $extraStatus = new static();

        return $extraStatus;
    }

    public function edit(): void
    {

    }

    public static function tableName()
    {
        return '{{%shop_product_extra_statuses}}';
    }


    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'extra_status_id',
                'tableName' => '{{%shop_product_extra_statuses_lang}}',
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }
}