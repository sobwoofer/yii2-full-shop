<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.11.17
 * Time: 11:32
 */

namespace core\entities;


use yii\db\ActiveRecord;

/**
 * Class Lang
 * @package core\entities
 * @property integer $id
 * @property string $url
 * @property string $locale
 * @property string $name
 * @property integer $default
 * @property integer $date_update
 * @property integer $date_create
 * @property integer $status
 *
 */
class Lang extends ActiveRecord
{

    public static function create($url, $locale, $name, $default, $status): self
    {
        $lang = new static();
        $lang->url = $url;
        $lang->locale = $locale;
        $lang->name = $name;
        $lang->default = $default;
        $lang->status = $status;
        return $lang;
    }

    public function edit($url, $locale, $name, $default, $status): void
    {
        $this->url = $url;
        $this->locale = $locale;
        $this->name = $name;
        $this->default = $default;
        $this->status = $status;
    }

    public static function tableName(): string
    {
        return '{{%lang}}';
    }

}