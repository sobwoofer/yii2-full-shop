<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 14:36
 */

namespace core\repositories\Shop;


use core\entities\Shop\Modification\ModificationGroup;
use core\repositories\NotFoundException;

class ModificationGroupRepository
{

    public function get($id): ModificationGroup
    {
        if (!$group = ModificationGroup::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Group of modification is not found.');
        }
        return $group;
    }

    public function save(ModificationGroup $group): void
    {
        if (!$group->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(ModificationGroup $group): void
    {
        if (!$group->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}