<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.09.17
 * Time: 14:39
 */

namespace core\readModels;

use core\entities\User\User;

class UserReadRepository
{
    public function find($id): ?User
    {
        return User::findOne($id);
    }

    public function findActiveByUsername($username): ?User
    {
        return User::findOne(['username' => $username, 'status' => User::STATUS_ACTIVE]);
    }

    public function findActiveById($id): ?User
    {
        return User::findOne(['id' => $id, 'status' => User::STATUS_ACTIVE]);
    }
}