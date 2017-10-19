<?php

namespace core\services;

use core\dispatchers\DeferredEventDispatcher;
/**
 * Class TransactionManager
 * @package core\services
 * Сервис оборачивает какую то последовательность сохранений в БД и в случае ошибки откатывает всю цепочку
 * последовательностей не позволяя части данных записаться без связей и возникновения подальших конфликтов
 * и ошибок в связи с этим.
 */
class TransactionManager
{
    private $dispatcher;

    public function __construct(DeferredEventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    public function wrap(callable $function): void
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $this->dispatcher->defer();
            $function();
            $transaction->commit();
            $this->dispatcher->release();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->dispatcher->clean();
            throw $e;
        }
    }
}