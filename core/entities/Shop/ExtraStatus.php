<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.12.17
 * Time: 17:15
 */

namespace core\entities\Shop;


use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

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

    public static function create($externalId, $slug, $names): self
    {
        $extraStatus = new static();
        $extraStatus->external_id = $externalId;
        $extraStatus->slug = $slug;

        //$deliveryTerm->name, $deliveryTerm->name_ua...
        foreach ($names as $name => $value) {
            $extraStatus->{$name} = $value;
        }

        return $extraStatus;
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
        return '{{%shop_extra_statuses}}';
    }


    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'extra_status_id',
                'tableName' => '{{%shop_extra_statuses_lang}}',
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