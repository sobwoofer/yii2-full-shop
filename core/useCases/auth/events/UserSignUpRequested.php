<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.10.17
 * Time: 15:19
 */

namespace core\useCases\auth\events;


use core\entities\User\User;

class UserSignUpRequested
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

}