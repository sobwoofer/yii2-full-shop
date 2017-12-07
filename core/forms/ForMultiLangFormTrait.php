<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.12.17
 * Time: 12:20
 */

namespace core\forms;

/**
 * Трейт используется в формах которые имеют мультиязычные поля для
 * переоперделения фреймворских геттеров и сеттеров, чтобы дать возможность
 * динамически создавать мультиязычные проперти типа $title_ua в уже созданных обьектах форм
 * Trait ForMultiLangFormTrait
 * @package core\forms
 */
trait ForMultiLangFormTrait
{
    public function __set($name, $value)
    {
        $this->$name = $value;
        return; //for can set dynamic multi language property
    }

    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            // read property, e.g. getName()
            return $this->$getter();
        }

        return $this->$name = ''; //for can set dynamic multi language property
    }

}