<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.01.18
 * Time: 15:00
 */

namespace core\forms\manage\Shop\PaymentMethod;


use core\entities\Shop\PaymentMethod\PaymentMethod;
use core\entities\Shop\Warehouse;
use core\forms\CompositeForm;
use core\forms\ForMultiLangFormTrait;
use core\helpers\LangsHelper;
use core\forms\manage\Shop\PaymentMethod\DeliveryForm;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class PaymentMethodForm
 * @package core\forms\manage\Shop
 * @property float $minCost
 * @property float $maxCost
 * @property integer $active
 * @property integer $warehouseId
 * @property string $name
 * @property string $name_ua
 * @property string $description
 * @property string $description_ua
 * @property DeliveryForm $delivery
 */
class PaymentMethodForm extends CompositeForm
{
    public $active;
    public $maxCost;
    public $minCost;
    public $warehouseId;

    public function __construct(PaymentMethod $method = null, array $config = [])
    {
        $this->delivery = new DeliveryForm();
        if ($method) {
            $this->active = $method->active;
            $this->minCost = $method->min_cost;
            $this->maxCost = $method->max_cost;
            $this->warehouseId = $method->warehouse_id;
            $this->delivery = new DeliveryForm($method);

            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $method->{'name' . $suffix};
                $this->{'description' . $suffix} = $method->{'description' . $suffix};
            }
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['minCost', 'maxCost'], 'string'],
            [['active', 'warehouseId'], 'string'],
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name', 'description']), 'string'],
        ];
    }

    protected function internalForms(): array
    {
        return ['delivery'];
    }

    public function getWarehouseList()
    {
        return ArrayHelper::map(Warehouse::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');

    }

}