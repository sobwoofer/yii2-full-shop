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
 * свойства созданного обьекта формы динамически создаются в цыкле конструктора, для этого пришлось переопределить
 * родительский метод __set() и __get() в композитной форме от которой наследуются всне формы "CompositeForm" и
 * в формах которые не композитны но имеют мультиязычные  поля. также MetaForm сюда касается
 * Создан хелпер "LangsHelper" для удобного извлечения суфиксов а также автоматического мультиленгвистического
 * не врот ебись заполнения rules форм для валидаций.
 * Создана таблица с действующими языками, сущность к ней и Рид репозиторий в ReadModels для извлечения всей языковой
 * лабуды.
 * Создано по таблице с переводами к каждой сущности что имеет мультиязычные поля а также по сущьности к этим таблицам
 * MetaBehavior перенесены именно туда. таким же образом была переделана суб форма мета так как для каждого языка из
 * класса формы мета создавался новый обьект а названия по сути было таким же - пришлось присобачить префикс еще и к
 * самим атрибутам на стороне фронтенда и в сервисах которые ее используют при редактировании и создании это учесть
 * чтобы все заработало.
 * В сущность из сервисов передаются проверенные массивы для мультиязычных полей, где крутятся и заполняют собою поля.
 * И конечно же не забыть переопределить метод find() либо заюзать трейт от плагина как в книжке пишет и при
 * вытягивании сущьности в цепочке запроса использовать метод ->multilingual() в сущьности .
 *
 * Class FilledMultilingualBehavior
 * @package core\entities\behaviors
 */
class FilledMultilingualBehavior extends MultilingualBehavior
{
    private $lang;

    public function __construct(LangReadRepository $lang,  array $config = [])
    {
        parent::__construct($config);
        $this->lang = $lang;

        $this->fillLanguages();

    }

    public function fillLanguages()
    {
        $this->languages = ArrayHelper::map($this->lang
            ->findAllActive(), 'url', 'name');
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