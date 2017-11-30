<?php

namespace core\forms\manage;

use core\entities\Meta;
use yii\base\Model;
use core\helpers\LangsHelper;

/**
 * Class MetaForm
 * @package core\forms\manage
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $title_ua
 * @property string $description_ua
 * @property string $keywords_ua
 */
class MetaForm extends Model
{
    public $title;
    public $description;
    public $keywords;

    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'title' . $suffix} = $meta->title;
                $this->{'description' . $suffix} = $meta->description;
                $this->{'keywords' . $suffix} = $meta->keywords;
            }
        }
        parent::__construct($config);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
        return; //for can set dynamic multi language property
//        parent::__set($name, $value);
    }

    public function __get($name)
    {

        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            // read property, e.g. getName()
            return $this->$getter();
        }

        return $this->$name = ''; //for can set dynamic multi language property
//        return parent::__get($name);
    }




    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['title']), 'string', 'max' => 255],
            [['description', 'keywords'], 'string'],
        ];
    }
}