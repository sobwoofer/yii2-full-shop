<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.01.18
 * Time: 16:40
 */

namespace core\forms\manage\Shop;


use core\entities\Shop\Discount;
use core\forms\ForMultiLangFormTrait;
use core\helpers\LangsHelper;
use yii\base\Model;

/**
 * Class DiscountForm
 * @package forms\manage\Shop
 * @property integer $percent;
 * @property string $fromDate;
 * @property string $toDate;
 * @property string $name;
 * @property string $name_ua;
 * @property string $description
 * @property string $description_ua;
 * @property bool $active;
 * @property integer $sort;
 */
class DiscountForm extends Model
{
    use ForMultiLangFormTrait;

    public $percent;
    public $fromDate;
    public $toDate;
    public $active;
    public $sort;

    public function __construct(Discount $discount = null, array $config = [])
    {
        if ($discount) {
            $this->percent = $discount->percent;
            $this->fromDate = $discount->from_date;
            $this->toDate = $discount->to_date;
            $this->active = $discount->active;
            $this->sort = $discount->sort;

            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $discount->{'name' . $suffix};
                $this->{'description' . $suffix} = $discount->{'description' . $suffix};
            }
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [['active', 'percent'], 'required'],
            [['percent', 'active', 'sort'], 'integer'],
            [LangsHelper::getNamesWithSuffix(['name', 'description']), 'string'],
            [['fromDate', 'toDate'], 'string']
        ];
    }

}