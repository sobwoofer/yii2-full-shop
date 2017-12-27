<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.12.17
 * Time: 17:31
 */

namespace core\forms\manage\Shop\Product;


use core\entities\Shop\Product\ModificationAssignment;
use yii\base\Model;
use core\entities\Shop\Modification\ModificationGroup;
use yii\helpers\ArrayHelper;

/**
 * Class ModificationAssignments
 * @package core\forms\manage\Shop\Product
 * @property integer $modificationId;
 * @property integer $minQty;
 * @property integer $status;
 */
class ModificationAssignmentsForm extends Model
{
    public $modificationId;
    public $minQty;
    public $status;

    public function __construct(ModificationAssignment $modificationAssign = null, $config = [])
    {
        if ($modificationAssign) {
            $this->modificationId = $modificationAssign->modification_id;
            $this->minQty = $modificationAssign->min_qty;
            $this->status = $modificationAssign->status;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['modificationId', 'required'],
            [['modificationId', 'minQty', 'status'], 'required'],
        ];
    }

    public function getGroupList()
    {
        return ArrayHelper::map(ModificationGroup::find()->all(), 'id' , 'name');
    }



}