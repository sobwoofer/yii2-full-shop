<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:32
 */

namespace core\forms\manage\Shop;


use core\entities\Shop\DeliveryTerm;
use core\forms\ForMultiLangFormTrait;
use core\helpers\LangsHelper;
use yii\base\Model;

/**
 * Class DeliveryTermForm
 * @package core\forms\manage\Shop
 * @property string $slug;
 * @property integer $value;
 * @property integer $externalId;
 * @property string $name;
 * @property string $name_ua;
 */
class DeliveryTermForm extends Model
{
    use ForMultiLangFormTrait;

    public $externalId;
    public $slug;
    public $value;

    public function __construct(DeliveryTerm $extraStatus = null, array $config = [])
    {
        if ($extraStatus) {
            $this->externalId = $extraStatus->external_id;
            $this->slug = $extraStatus->slug;

            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $extraStatus->{'name' . $suffix};
            }
        }
        parent::__construct($config);
    }



    public function rules()
    {
        return [
            [['slug'], 'required'],
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name']), 'string'],
            ['slug', 'string'],
            [['externalId', 'value'], 'integer'],
        ];
    }

}