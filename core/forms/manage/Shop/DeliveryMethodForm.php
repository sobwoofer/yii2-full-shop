<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:16
 */

namespace core\forms\manage\Shop;

use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use core\forms\ForMultiLangFormTrait;
use yii\base\Model;
use core\helpers\LangsHelper;

class DeliveryMethodForm extends Model
{
    use ForMultiLangFormTrait;

    public $name;
    public $cost;
    public $minWeight;
    public $maxWeight;
    public $sort;

    public function __construct(DeliveryMethod $method = null, $config = [])
    {
        if ($method) {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $method->{'name' . $suffix};
                $this->{'description' . $suffix} = $method->{'description' . $suffix};
            }

            $this->cost = $method->cost;
            $this->minWeight = $method->min_weight;
            $this->maxWeight = $method->max_weight;
            $this->sort = $method->sort;
        } else {
            $this->sort = DeliveryMethod::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [['cost', 'sort'], 'required'],
            [LangsHelper::getNamesWithSuffix(['name', 'description']), 'string', 'max' => 255],
            [['cost', 'minWeight', 'maxWeight', 'sort'], 'integer'],
        ];
    }


}