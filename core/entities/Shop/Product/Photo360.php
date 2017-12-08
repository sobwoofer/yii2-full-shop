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

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/products360/[[attribute_product_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/products360/[[attribute_product_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/products360/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/products360/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 320, 'height' => 240],
                    'catalog_product_main' => ['processor' => [new WaterMarker(616, 516, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                    'catalog_origin' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                ],
            ],
        ];
    }

}