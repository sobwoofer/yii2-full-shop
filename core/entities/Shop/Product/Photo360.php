<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.12.17
 * Time: 11:19
 */

namespace core\entities\Shop\Product;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use core\services\WaterMarker;
use yii\base\Event;

/**
 * Class Photo
 * @package core\entities\Shop\Product
 * @property integer $id
 * @property string $file
 * @property integer $sort
 *
 * @mixin ImageUploadBehavior
 */
class Photo360 extends ActiveRecord
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
        return '{{%shop_photos360}}';
    }

    /**
     * for magic360 library because it does not read file to filename_1. need filename_01
     */
    public function afterFind()
    {
        $this->sort = sprintf("%02d", $this->sort);
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/products360/[[attribute_product_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/products360/[[attribute_product_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/products360/[[attribute_product_id]]/[[profile]]_[[id]]_[[attribute_sort]].[[extension]]',
                'thumbUrl' => '@static/cache/products360/[[attribute_product_id]]/[[profile]]_[[id]]_[[attribute_sort]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 320, 'height' => 240],
                    'product_main' => ['processor' => [new WaterMarker(616, 516, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                    'product_big' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                ],
            ],
        ];
    }

}