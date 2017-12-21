<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:08
 */

namespace core\repositories\Shop;


use core\entities\Shop\ExtraStatus;
use core\repositories\NotFoundException;

class ExtraStatusRepository
{
    public function get($id): ExtraStatus
    {
        if (!$method = ExtraStatus::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('DeliveryMethod is not found.');
        }
        return $method;
    }

    public function findByExternalId($id): ?ExtraStatus
    {
        return ExtraStatus::findOne(['external_id' => $id]);
    }

    public function save(ExtraStatus $status): void
    {
        if (!$status->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(ExtraStatus $status): void
    {
        if (!$status->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}