<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 11:02
 */

namespace core\forms\manage\Shop;


use core\entities\Geo\City;
use core\entities\Shop\Warehouse;
use core\forms\ForMultiLangFormTrait;
use yii\base\Model;
use core\helpers\LangsHelper;
use yii\helpers\ArrayHelper;

/**
 * Class WarehouseForm
 * @package forms\manage\Shop
 * @property integer $cityId
 * @property float $minOrder
 * @property string $slug
 * @property string $name
 * @property string $address
 * @property integer $default
 * @property string $description
 * @property string $name_ua
 * @property string $address_ua
 * @property string $description_ua
 */
class WarehouseForm extends Model
{
    use ForMultiLangFormTrait;

    public  $cityId;
    public  $minOrder;
    public  $slug;
    public  $default;
    public  $_warehouse;


    public function __construct(Warehouse $warehouse = null, array $config = [])
    {
        if ($warehouse) {
            $this->cityId = $warehouse->city_id;
            $this->minOrder = $warehouse->min_order;
            $this->slug = $warehouse->slug;
            $this->default = $warehouse->default;

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $this->{'name' . $suffix} = $warehouse->{'name' . $suffix};
            $this->{'address' . $suffix} = $warehouse->{'address' . $suffix};
            $this->{'description' . $suffix} = $warehouse->{'description' . $suffix};
        }

            $this->_warehouse = $warehouse;
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
            [LangsHelper::getNamesWithSuffix(['name', 'address']), 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description']), 'string'],
            [['cityId', 'minOrder'], 'required'],
            [['cityId', 'default'], 'integer'],
            ['slug', 'string', 'max' => 255],
            ['minOrder', 'string'],
            ['slug', 'unique', 'targetClass' => Warehouse::class, 'filter' => $this->_warehouse ? ['<>', 'id', $this->_warehouse->id] : null]
        ];
    }


}