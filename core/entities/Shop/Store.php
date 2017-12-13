<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:44
 */

namespace core\entities\Shop;


use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;
use core\entities\behaviors\FilledMultilingualBehavior;
use yiidreamteam\upload\ImageUploadBehavior;
use core\services\WaterMarker;
use yii\web\UploadedFile;
use yii\db\ActiveQuery;
use core\entities\Geo\City;

/**
 * this entity describes real stores of company when sale productions
 * Class Store
 * @package core\entities\Shop
 * @property integer $id
 * @property integer $city_id
 * @property string $phone
 * @property string $email
 * @property string $work_weekdays
 * @property string $work_weekend
 * @property UploadedFile $photo
 * @property string $slug
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $name_ua
 * @property string $address_ua
 * @property string $description_ua
 * @property City $city
 *
 * @mixin ImageUploadBehavior
 */
class Store extends ActiveRecord
{
    public static function create(
        $cityId,
        $phone,
        $email,
        $workWeekdays,
        $workWeekend,
        $slug,
        array $names,
        array $addresses,
        array $descriptions
    ): self
    {
        $store = new static();
        $store->city_id = $cityId;
        $store->phone = $phone;
        $store->email = $email;
        $store->work_weekdays = $workWeekdays;
        $store->work_weekend = $workWeekend;
        $store->slug = $slug;

        //$store->name, $store->name_ua...
        foreach ($names as $name => $value) {
            $store->{$name} = $value;
        }

        //$store->address, $store->address_ua...
        foreach ($addresses as $name => $value) {
            $store->{$name} = $value;
        }

        //$store->description, $store->$description_ua...
        foreach ($descriptions as $name => $value) {
            $store->{$name} = $value;
        }

        return $store;
    }

    public function edit(
        $cityId,
        $phone,
        $email,
        $workWeekdays,
        $workWeekend,
        $slug,
        array $names,
        array $addresses,
        array $descriptions
    ): void
    {
        $this->city_id = $cityId;
        $this->phone = $phone;
        $this->email = $email;
        $this->work_weekdays = $workWeekdays;
        $this->work_weekend = $workWeekend;
        $this->slug = $slug;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->address, $this->address_ua...
        foreach ($addresses as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }

    }

    public function setPhoto(UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function removePhoto(): void
    {
        $this->photo = '';
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_stores}}';
    }

    //Relations

    public function getCity(): ActiveQuery
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
//                'langClassName' => PageLang::className(),
                'langForeignKey' => 'store_id',
                'tableName' => '{{%shop_stores_lang}}',
                'attributes' => [
                    'name', 'address', 'description'
                ]
            ],
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/stores/[[id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/stores/[[id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/stores/[[id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/stores/[[id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 320, 'height' => 240],
                    'big' => ['processor' => [new WaterMarker(1024, 768, '@frontend/web/images/system/logo-papirus.png'), 'process']],
                ],
            ],
        ];
    }

}