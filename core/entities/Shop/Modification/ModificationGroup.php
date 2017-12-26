<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 13:03
 */

namespace core\entities\Shop\Modification;


use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;
use core\entities\behaviors\FilledMultilingualBehavior;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * Class ModificationGroup
 * @package entities\Shop\Modification
 * @property integer $id
 * @property integer $status
 * @property string $slug
 * @property string $image
 * @property string $name
 * @property string $name_ua
 * @property string $description
 * @property string $description_ua
 *
 * @mixin ImageUploadBehavior
 */
class ModificationGroup extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    public static function create($status, $slug, $image, array $names, array $descriptions): self
    {
        $group = new static();
        $group->status = $status;
        $group->slug = $slug;
        $group->image = $image;

        //$group->name, $group->name_ua...
        foreach ($names as $name => $value) {
            $group->{$name} = $value;
        }

        //$group->description, $group->$description_ua...
        foreach ($descriptions as $name => $value) {
            $group->{$name} = $value;
        }


        return $group;
    }

    public function edit($status, $slug, $image, array $names, array $descriptions): void
    {
        $this->status = $status;
        $this->slug = $slug;
        $this->image = $image;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function setPhoto(UploadedFile $image): void
    {
        $this->image = $image;
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'image',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/modification-groups/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/modification-groups/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/modification-groups/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/modification-groups/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'thumb' => ['width' => 232, 'height' => 100],
                    'product_page' => ['width' => 170, 'height' => 27],
                ],
            ],
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'group_id',
                'tableName' => '{{%shop_modification_groups_lang}}',
                'attributes' => [
                    'name', 'description'
                ]
            ],
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_modification_groups}}';
    }

}