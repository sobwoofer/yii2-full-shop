<?php

namespace core\services;

/**
 * Class TransactionManager
 * @package core\services
 * Сервис оборачивает какую то последовательность сохранений в БД и в случае ошибки откатывает всю цепочку
 * последовательностей не позволяя части данных записаться без связей и возникновения подальших конфликтов
 * и ошибок в связи с этим.
 */
class TransactionManager
{
    public function wrap(callable $function): void
    {
        \Yii::$app->db->transaction($function);
    }
}