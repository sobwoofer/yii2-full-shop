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
use yii\base\UnknownPropertyException;
use yii\db\ActiveRecord;

class FilledMultilingualBehavior extends MultilingualBehavior
{
    private $langs;

    public function __construct(LangReadRepository $langs,  array $config = [])
    {
        parent::__construct($config);
        $this->langs = $langs;

        $this->fillLanguages();

    }

    public function fillLanguages()
    {
        $this->languages = ArrayHelper::map($this->langs->findAllActive(), 'url', 'name');
//        $this->languages = ['ru', 'ua'];
    }

    /**
     * Handle 'afterUpdate' event of the owner.
     */
    public function afterUpdate()
    {
        /** @var ActiveRecord $owner */
        $owner = $this->owner;
        $owner->populateRelation('translations', $owner->translations);

       parent::afterUpdate();
    }

}