<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 15:24
 */

namespace core\forms\manage\Shop\Modification;

use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Modification\ModificationGroup;
use core\forms\ForMultiLangFormTrait;
use yii\base\Model;
use core\helpers\LangsHelper;
use yii\helpers\ArrayHelper;

/**
 * Class ModificationForm
 * @package core\forms\manage\Shop\Modification
 * @property string $caseCode
 * @property string $code
 * @property string $name
 * @property string $name_ua
 * @property float $price
 * @property integer $managerId
 * @property integer $groupId
 * @property integer $status
 */
class ModificationForm extends Model
{
    use ForMultiLangFormTrait;

    public $code;
    public $name;
    public $price;
    public $caseCode;
    public $managerId;
    public $groupId;
    public $status;

    public function __construct(Modification $modification = null, $config = [])
    {
        if ($modification) {
            $this->code = $modification->code;
            $this->price = $modification->price;
            $this->managerId = $modification->manager_id;
            $this->groupId = $modification->group_id;
            $this->status = $modification->status;
            $this->caseCode = $modification->case_code;
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $modification->{'name' . $suffix};
            }
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name']), 'string'],
            ['caseCode', 'string'],
            [['code', 'name', 'status'], 'required'],
            [['price', 'managerId', 'status', 'groupId'], 'integer'],
        ];
    }

    public function getGroupList()
    {
        return ArrayHelper::map(ModificationGroup::find()->all(), 'id' , 'name');
    }
}