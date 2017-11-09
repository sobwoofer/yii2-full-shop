<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.11.17
 * Time: 12:08
 */

namespace core\forms\manage;


use core\entities\Lang;
use yii\base\Model;

class LangForm extends Model
{
    public $url;
    public $locale;
    public $name;
    public $default;
    public $status;

    private $_lang;

    public function __construct(Lang $lang = null, array $config = [])
    {
        if ($lang) {
            $this->url = $lang->url;
            $this->locale = $lang->locale;
            $this->name = $lang->name;
            $this->default = $lang->default;
            $this->status = $lang->status;
            $this->_lang = $lang;
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['default', 'status'], 'integer'],
            [['url', 'locale', 'name'], 'string', 'max' => 255],
        ];
    }

}