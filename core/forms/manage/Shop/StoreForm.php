<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 11:02
 */

namespace core\forms\manage\Shop;


use core\entities\Geo\City;
use core\entities\Shop\Store;
use yii\web\UploadedFile;
use core\forms\ForMultiLangFormTrait;
use yii\base\Model;
use core\helpers\LangsHelper;
use yii\helpers\ArrayHelper;

/**
 * Class WarehouseForm
 * @package forms\manage\Shop
 * @property integer $cityId
 * @property string $phone
 * @property string $email
 * @property string $workWeekdays
 * @property string $workWeekend
 * @property UploadedFile $photo
 * @property string $slug
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $name_ua
 * @property string $address_ua
 * @property string $description_ua
 */
class StoreForm extends Model
{
    use ForMultiLangFormTrait;

    public  $cityId;
    public  $phone;
    public  $email;
    public  $workWeekdays;
    public  $workWeekend;
    public  $photo;
    public  $slug;

    public  $_store;


    public function __construct(Store $store = null, array $config = [])
    {
        if ($store) {
            $this->cityId = $store->city_id;
            $this->phone = $store->phone;
            $this->email = $store->email;
            $this->workWeekdays = $store->work_weekdays;
            $this->workWeekend = $store->work_weekend;
            $this->slug = $store->slug;

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $this->{'name' . $suffix} = $store->{'name' . $suffix};
            $this->{'address' . $suffix} = $store->{'address' . $suffix};
            $this->{'description' . $suffix} = $store->{'description' . $suffix};
        }

            $this->_store = $store;
        }

        parent::__construct($config);
    }

    public function cityList()
    {
        return ArrayHelper::map(City::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    public function rules()
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name', 'address']), 'required'],
            [['cityId', 'workWeekdays', 'workWeekend'], 'required'],
            [['slug', 'phone', 'workWeekdays', 'workWeekend'], 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['name', 'address']), 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description']), 'string'],
            [['cityId'], 'integer'],
            ['email', 'email'],
            ['photo', 'image'],
            ['slug', 'unique', 'targetClass' => Store::class, 'filter' => $this->_store ? ['<>', 'id', $this->_store->id] : null]
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }


}