<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 14:22
 */

namespace core\repositories\Shop;


use core\entities\Shop\Modification\Modification;
use core\repositories\NotFoundException;
use yii\db\ActiveRecord;

class ModificationRepository
{

    /**
     * @param $id
     * @return Modification
     */
    public function get($id): Modification
    {
        if (!$modification = Modification::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Modification is not found.');
        }
        return $modification;
    }

    public function save(Modification $modification): void
    {
        if (!$modification->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Modification $modification): void
    {
        if (!$modification->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}