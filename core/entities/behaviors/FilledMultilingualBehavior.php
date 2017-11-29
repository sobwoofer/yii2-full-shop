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

/**
 * Что было сделано для мультиленгвича:
 * Привязан к каждой сущьности и настроено поведения "MultilingualBehavior" который был унаследован и переопределен
 * Этим собственно классом.
 * Видоизменен конструктор менеджментской формы сущности чтобы поля заполнялись автоматически, тоесть
 * свойства созданного обьекта формы динамически создаются в цыкле конструктора, для этого пришлось отключить
 * родительский метод __set() в композитной форме от которой наследуются всне формы "CompositeForm".
 * Создан хелпер "LangsHelper" для удобного извлечения суфиксов а также автоматического мультиленгвистического
 * не врот ебись заполнения rules форм для валидаций.
 * Создана таблица с действующими языками, сущность к ней и Рид репозиторий в ReadModels для извлечения всей языковой
 * лабуды.
 * Создано по таблице с переводами к каждой сущности что имеет мультиязычные поля а также по сущьности к этим таблицам
 * MetaBehavior перенесены именно туда.
 *
 * Class FilledMultilingualBehavior
 * @package core\entities\behaviors
 */
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