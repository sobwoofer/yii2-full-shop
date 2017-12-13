<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 11:02
 */

namespace core\forms\manage\Shop;


use core\entities\Geo\City;
use core\entities\Shop\GivePoint;
use core\entities\Shop\Store;
use core\entities\Shop\Warehouse;
use core\forms\ForMultiLangFormTrait;
use yii\base\Model;
use core\helpers\LangsHelper;
use yii\helpers\ArrayHelper;

/**
 * Class WarehouseForm
 * @package forms\manage\Shop
 * @property integer $warehouseId
 * @property integer $storeId
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string $name_ua
 * @property string $description_ua
 */
class GivePointForm extends Model
{
    use ForMultiLangFormTrait;

    public  $warehouseId;
    public  $storeId;
    public  $slug;

    public  $_givePoint;


    public function __construct(GivePoint $givePoint = null, array $config = [])
    {
        if ($givePoint) {
            $this->warehouseId = $givePoint->warehouse_id;
            $this->storeId = $givePoint->store_id;
            $this->slug = $givePoint->slug;

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $this->{'name' . $suffix} = $givePoint->{'name' . $suffix};
            $this->{'description' . $suffix} = $givePoint->{'description' . $suffix};
        }

            $this->_givePoint = $givePoint;
        }

        parent::__construct($config);
    }

    public function storeList()
    {
        return ArrayHelper::map(Store::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    public function warehouseList()
    {
        return ArrayHelper::map(Warehouse::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    public function rules()
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description']), 'string'],
            [['storeId', 'warehouseId'], 'required'],
            [['storeId', 'warehouseId'], 'integer'],
            ['slug', 'string', 'max' => 255],
            ['slug', 'unique', 'targetClass' => GivePoint::class, 'filter' => $this->_givePoint ? ['<>', 'id', $this->_givePoint->id] : null]
        ];
    }


}