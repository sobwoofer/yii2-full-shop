<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.12.17
 * Time: 12:15
 */

namespace core\forms\manage\Shop\Product;


use yii\base\Model;

class BuyWithForm extends Model
{
    public $relatedId;

    public function rules()
    {
        return [
            ['relatedId', 'required'],
            ['relatedId', 'integer'],
        ];
    }

}