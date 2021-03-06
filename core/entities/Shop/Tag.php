<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 10.08.17
 * Time: 17:08
 */

namespace core\entities\Shop;


use yii\db\ActiveRecord;

/**
 * Class Tag
 * @package core\entities\User
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    public static function create($name, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public static function tableName(): string
    {
        return '{{%shop_tags}}';
    }

}