<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.08.17
 * Time: 16:27
 */

namespace services;


use shop\entities\User;
use shop\forms\LoginForm;
use shop\repositories\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password');
        }
        return $user;
    }

}