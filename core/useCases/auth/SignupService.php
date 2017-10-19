<?php
/**
 * This class is registered and confirmed user into system.
 */

namespace core\useCases\auth;

use core\dispatchers\EventDispatcher;
use core\entities\User\User;
use core\forms\auth\SignupForm;
use core\repositories\UserRepository;
use core\access\Rbac;
use core\services\RoleManager;
use core\services\TransactionManager;

class SignupService
{
    private $users;
    private $roles;
    private $transaction;
    private $dispatcher;

    public function __construct(
        UserRepository $users,
        RoleManager $roles,
        TransactionManager $transaction,
        EventDispatcher $dispatcher
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
        $this->dispatcher = $dispatcher;
    }

    public function signup(SignupForm $form): void
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->phone,
            $form->password
        );

        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });

        $this->dispatcher->dispatchAll($user->releaseEvents());

    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);

        $this->dispatcher->dispatchAll($user->releaseEvents());
    }
}