<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.12.17
 * Time: 12:16
 */

namespace core\entities\Page;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class PageLang
 * @package core\entities\Page
 * @property Meta;
 */
class PageLang extends ActiveRecord
{
    public $meta;

    public function behaviors()
    {
        return [
            MetaBehavior::className(),
        ];
    }

    public static function tableName()
    {
        return '{{%pages_lang}}';
    }

}