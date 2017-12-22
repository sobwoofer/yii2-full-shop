<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 14:09
 */

namespace forms\manage\Shop\Modification;


use core\helpers\LangsHelper;
use yii\base\Model;
use core\forms\ForMultiLangFormTrait;

/**
 * Class ModificationGroupForm
 * @package forms\manage\Shop\Modification
 */
class ModificationGroupForm extends Model
{
    use ForMultiLangFormTrait;

    public $status;
    public $slug;
    public $image;

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name', 'description']), 'string'],
            [['status', 'slug'], 'required'],
            ['status', 'integer'],
            ['slug', 'string'],
        ];
    }
}