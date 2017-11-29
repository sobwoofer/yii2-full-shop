<?php

namespace core\forms\manage;

use core\entities\Meta;
use yii\base\Model;

class MetaForm extends Model
{
    public $title;
    public $title_ua;
    public $description;
    public $keywords;

    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            $this->title = $meta->title;
            $this->description = $meta->description;
            $this->keywords = $meta->keywords;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['title', 'title_ua'], 'string', 'max' => 255],
            [['description', 'keywords'], 'string'],
        ];
    }
}