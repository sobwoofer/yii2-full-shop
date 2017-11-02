<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 16.08.17
 * Time: 16:41
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

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'cart_list' => ['width' => 47, 'height' => 47],
                    'cart_widget_list' => ['width' => 33, 'height' => 33],
                    'catalog_list' => ['width' => 154, 'height' => 151],
                    'catalog_product_main' => ['processor' => [new WaterMarker(616, 516, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                    'catalog_product_additional' => ['width' => 90, 'height' => 90],
                    'catalog_origin' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                ],
            ],
        ];
    }

}