<?php

namespace shop\forms;

use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class CompositeForm
 * @package shop\forms
 * Клас создан для расширеного использования стандартных форм, его нужно наследовать в класах обычных форм вместо
 * класса yii\base\Model. В нем переопределяется методы форм load() и validate()
 * для того чтобы иметь возможность загружать одну форму внутри другой, в таких ситуациях например как заполнения
 * формы создания страницы и паралельно заполнения формы мета тегов этой страницы которые заполняются в отдельной
 * модели формы.
 */
abstract class CompositeForm extends Model
{
    /**
     * @var Model[]|array[]
     */
    private $forms = [];

    /**
     * @return array
     * в методе наследнике должны быть перечисленны названия форм которые будут вложенными
     */
    abstract protected function internalForms(): array;

    public function load($data, $formName = null): bool
    {
        //вызвали родительский клас для заполнения родительской формы
        $success = parent::load($data, $formName);
        //крутим массив субформ которые прилители в метод internalForms()
        foreach ($this->forms as $name => $form) {
            //загрузка данных в форму из $data, если в load передано пустое имя формы $formName
            //(что значит грузить элементы из корня массива) то просим его грузить данные в субформу
            //из масива по ключу названия субформуы $data[имя субформы]. В инном случае передаем
            //null что значит что ключ будет выбран автоматически исходя из названия субформы.
            if (is_array($form)) {
                //сработает в случае если придет масив из нескольких субформ
                $success = Model::loadMultiple($form, $data, $formName === null ? null : $name) && $success;
            } else {
                //заполнения одной формы
                $success = $form->load($data, $formName !== '' ? null : $name) && $success;
            }
        }
        return $success;
    }

    public function validate($attributeNames = null, $clearErrors = true): bool
    {
        //если пришел attributeNames то отсеиваем из него для родительской формы все вложенные формы
        //которые будут приходить массивами а обычные поля все будут строками.
        $parentNames = $attributeNames !== null ? array_filter((array)$attributeNames, 'is_string') : null;
        //вызов родительского валидатора для валидации родительской формы
        $success = parent::validate($parentNames, $clearErrors);
        //крутим массив субформ которые прилители в метод internalForms()
        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                //сработает в случае если придет масив из нескольких субформ
                $success = Model::validateMultiple($form) && $success;
            } else {
                //валидация одной субформы
                $innerNames = $attributeNames !== null ? ArrayHelper::getValue($attributeNames, $name) : null;
                $success = $form->validate($innerNames ?: null, $clearErrors) && $success;
            }
        }
        return $success;
    }

    /**
     * @param string $name
     * @return array|mixed|Model
     * тут мы извлекаем записанные в обьект формы.
     */
    public function __get($name)
    {
        if (isset($this->forms[$name])) {
            return $this->forms[$name];
        }
        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * этим мы записываем данные масив свойства $forms по ключу названия формы.
     */
    public function __set($name, $value)
    {
        if (in_array($name, $this->internalForms(), true)) {
            $this->forms[$name] = $value;
        } else {
            parent::__set($name, $value);
        }
    }

    public function __isset($name)
    {
        return isset($this->forms[$name]) || parent::__isset($name);
    }
}