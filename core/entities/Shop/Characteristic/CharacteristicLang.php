<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.12.17
 * Time: 12:14
 */

namespace core\entities\Shop\Characteristic;


use yii\db\ActiveRecord;
use yii\helpers\Json;

class CharacteristicLang extends ActiveRecord
{
    public $variants;

    public static function tableName()
    {
        return '{{%shop_characteristics_lang}}';
    }

    public function afterFind(): void
    {

        $this->variants = Json::decode($this->getAttribute('variants_json'));

        parent::afterFind();
    }

    public function beforeSave($insert): bool
    {

        $this->setAttribute('variants_json', Json::encode($this->variants));
        return parent::beforeSave($insert);
    }

}