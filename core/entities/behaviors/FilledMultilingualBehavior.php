<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.11.17
 * Time: 14:11
 */

namespace core\entities\behaviors;


use core\entities\Lang;
use omgdef\multilingual\MultilingualBehavior;
use core\readModels\LangReadRepository;
use yii\helpers\ArrayHelper;

class FilledMultilingualBehavior extends MultilingualBehavior
{
    private $langs;

    public function __construct(LangReadRepository $langs,  array $config = [])
    {
        $this->langs = $langs;

        $this->fillLanguages();
        parent::__construct($config);
    }

    public function fillLanguages()
    {
        $this->languages = ArrayHelper::map($this->langs->findAllActive(), 'id', 'name');
    }

}