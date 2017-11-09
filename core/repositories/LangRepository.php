<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.11.17
 * Time: 12:01
 */

namespace core\repositories;


use core\entities\Lang;

class LangRepository
{
    public function get($id): Lang
    {
        if (!$lang = Lang::findOne($id)) {
            throw new NotFoundException('Lang is not found');
        }
        return $lang;
    }

    public function save(Lang $lang): void
    {
        if (!$lang->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Lang $lang): void
    {
        if (!$lang->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}