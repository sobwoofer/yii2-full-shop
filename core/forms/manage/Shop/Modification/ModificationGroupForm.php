<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 14:09
 */

namespace core\forms\manage\Shop\Modification;


use core\entities\Shop\Modification\ModificationGroup;
use core\helpers\LangsHelper;
use yii\base\Model;
use core\forms\ForMultiLangFormTrait;
use yii\web\UploadedFile;

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
    public $_group;

    public function __construct(ModificationGroup $group = null, array $config = [])
    {
        if ($group) {
            $this->status = $group->status;
            $this->slug = $group->slug;
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $group->{'name' . $suffix};
                $this->{'description' . $suffix} = $group->{'description' . $suffix};
            }
            $this->_group = $group;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name', 'description']), 'string'],
            [['status', 'slug'], 'required'],
            ['status', 'integer'],
            [['image'], 'image'],
            ['slug', 'string'],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}