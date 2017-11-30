<?php

namespace core\forms;

use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class CompositeForm
 * @package core\forms
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
     * в методе наследнике должны быть перечисленны названия форм которые будут вложенными.
     * parent::load() вызвали родительский клас для заполнения родительской формы
     * крутим массив субформ которые прилители в метод internalForms()
     * загрузка данных в форму из $data, если в load передано пустое имя формы $formName
     * (что значит грузить элементы из корня массива) то просим его грузить данные в субформу
     * из масива по ключу названия субформуы $data[имя субформы]. В инном случае передаем
     * null что значит что ключ будет выбран автоматически исходя из названия субформы.
     * if (is_array($form)) сработает в случае если придет масив из нескольких субформ
     * else заполнения одной формы
     */
    abstract protected function internalForms(): array;

    public function load($data, $formName = null): bool
    {

        $success = parent::load($data, $formName);


        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                $success = Model::loadMultiple($form, $data, $formName === null ? null : $name) && $success;
            } else {
                $success = $form->load($data, $formName !== '' ? null : $name) && $success;
            }
        }

        return $success;
    }

    /**
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     * если пришел attributeNames то отсеиваем из него для родительской формы все вложенные формы
     * которые будут приходить массивами а обычные поля все будут строками.
     * вызов родительского валидатора для валидации родительской формы
     * крутим массив субформ которые прилители в метод internalForms()
     * if (is_array($form)) сработает в случае если придет масив из нескольких субформ
     * else валидация одной субформы
     */
    public function validate($attributeNames = null, $clearErrors = true): bool
    {


        $parentNames = $attributeNames !== null ? array_filter((array)$attributeNames, 'is_string') : null;
        $success = parent::validate($parentNames, $clearErrors);

        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                $success = Model::validateMultiple($form) && $success;
            } else {
                $innerNames = $attributeNames !== null ? ArrayHelper::getValue($attributeNames, $name) : null;
                $success = $form->validate($innerNames ?: null, $clearErrors) && $success;
            }
        }
        return $success;
    }

    public function hasErrors($attribute = null): bool
    {

//        var_dump($this->forms);
//        die();
        if ($attribute !== null) {
            return parent::hasErrors($attribute);
        }

        if (parent::hasErrors($attribute)) {
            return true;
        }

        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                foreach ($form as $i => $item) {
                    if ($item->hasErrors()) {
                        return true;
                    }
                }
            } else {
                if ($form->hasErrors()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getFirstErrors(): array
    {

        $errors = parent::getFirstErrors();
        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                foreach ($form as $i => $item) {
                    foreach ($item->getFirstErrors() as $attribute => $error) {
                        $errors[$name . '.' . $i . '.' . $attribute] = $error;
                    }
                }
            } else {
                foreach ($form->getFirstErrors() as $attribute => $error) {
                    $errors[$name . '.' . $attribute] = $error;
                }
            }
        }
        return $errors;
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
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            // read property, e.g. getName()
            return $this->$getter();
        }

        // behavior property
//        $this->ensureBehaviors();
//        foreach ($this->_behaviors as $behavior) {
//            if ($behavior->canGetProperty($name)) {
//                return $behavior->$name;
//            }
//        }

        return $this->$name = ''; //for can set dynamic multi language property

//        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * этим мы записываем данные масив свойства $forms по ключу названия формы.
     */
    public function __set($name, $value)
    {

        foreach ($this->internalForms() as $internalForm) {
            if ($internalForm == $name) {
                $this->forms[$name] = $value;
            } elseif (is_array($internalForm)){
                foreach ($internalForm as $item) {
                    if ($item == $name) {
                        $this->forms[$name] = $value;
                    }
                }
            } else {
                $this->$name = $value;
                return; //for can set dynamic multi language property
//                parent::__set($name, $value);
            }

        }
    }

    public function __isset($name)
    {
        return isset($this->forms[$name]) || parent::__isset($name);
    }
}