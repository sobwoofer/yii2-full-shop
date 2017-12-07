<?php

namespace core\forms\manage\Shop;

use core\entities\Shop\Characteristic\Characteristic;
use core\forms\ForMultiLangFormTrait;
use core\helpers\LangsHelper;
use yii\base\Model;
use core\helpers\CharacteristicHelper;

/**
 * Class CharacteristicForm
 * @package core\forms\manage\Shop
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    use ForMultiLangFormTrait;

    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic) {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $characteristic->{'name' . $suffix};
                $this->{'textVariants' . $suffix} = implode(PHP_EOL, $characteristic->{'variants' . $suffix});
            }

            $this->type = $characteristic->type;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;

            $this->sort = $characteristic->sort;
            $this->_characteristic = $characteristic;

        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);

    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [['type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['textVariants']), 'string'],
            [['sort'], 'integer'],
//            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }

    public function typesList(): array
    {
        return CharacteristicHelper::typeList();
    }

    public function getVariants(): \stdClass
    {
        $variants = new \stdClass();
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang){
            $variants->{$suffix} = preg_split('#\s+#i', $this->{'textVariants' . $suffix});
        }

        return $variants;
    }


}