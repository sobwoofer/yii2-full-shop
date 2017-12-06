<?php

namespace core\entities\Shop\Characteristic;

use yii\db\ActiveRecord;
use yii\helpers\Json;
use core\entities\behaviors\FilledMultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 */
class Characteristic extends ActiveRecord
{
    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';

//    public $variants;

    public static function create(array $names, array $variants, $type, $required, $default, $sort): self
    {
        $object = new static();
        //$object->name, $object->name_ua...
        foreach ($names as $name => $value) {
            $object->{$name} = $value;
        }
        //$object->variants, $object->variant_ua...
        foreach ($variants as $name => $value) {
            $object->{$name} = $value;
        }

        $object->type = $type;
        $object->required = $required;
        $object->default = $default;
        $object->sort = $sort;
        return $object;
    }

    public function edit(array $names, array $variants, $type, $required, $default, $sort): void
    {
        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }
        //$this->variants, $this->variant_ua...
        foreach ($variants as $name => $value) {
            $this->{$name} = $value;
        }

        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
        $this->sort = $sort;
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }

    public static function tableName(): string
    {
        return '{{%shop_characteristics}}';
    }


    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false, //true because class does not have Lang entity
                'langClassName' => CharacteristicLang::className(), // or namespace/for/a/class/CategoryLang
                'langForeignKey' => 'characteristic_id',
                'tableName' => '{{%shop_characteristics_lang}}',
                'attributes' => [
                    'name', 'variants'
                ]
            ],
        ];
    }

    //TODO yii2 EAV http://www.elisdn.ru/blog/31/dinamicheskie-atributi-dlia-tovarov-ispolzovanie-eav-v-yii
}