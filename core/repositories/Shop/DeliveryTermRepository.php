<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:10
 */

namespace core\repositories\Shop;


use core\entities\Shop\DeliveryTerm;
use core\repositories\NotFoundException;

class DeliveryTermRepository
{
    public function get($id): DeliveryTerm
    {
        if (!$term = DeliveryTerm::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('DeliveryMethod is not found.');
        }
        return $term;
    }

    public function findByExternalId($id): ?DeliveryTerm
    {
        return DeliveryTerm::findOne(['external_id' => $id]);
    }

    public function save(DeliveryTerm $term): void
    {
        if (!$term->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(DeliveryTerm $term): void
    {
        if (!$term->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}