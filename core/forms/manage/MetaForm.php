<?php

namespace core\forms\manage;

use core\entities\Meta;
use core\forms\ForMultiLangFormTrait;
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
    use ForMultiLangFormTrait;

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

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['title']), 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description', 'keywords']), 'string'],
        ];
    }
}