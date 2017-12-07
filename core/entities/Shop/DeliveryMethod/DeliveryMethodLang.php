<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.12.17
 * Time: 12:03
 */

namespace core\entities\Shop\DeliveryMethod;


use yii\db\ActiveRecord;

class DeliveryMethodLang extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%shop_delivery_methods_lang}}';
    }

}