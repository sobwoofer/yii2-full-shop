<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 16.08.17
 * Time: 16:41
 */

namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class Photo
 * @package shop\entities\Shop\Product
 * @property integer $id
 * @property string $file
 * @property integer $sort
 */
class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_photos}}';
    }

}