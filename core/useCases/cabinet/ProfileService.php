<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.10.17
 * Time: 10:37
 */

namespace core\useCases\cabinet;

use core\forms\User\ProfileEditForm;
use core\repositories\UserRepository;

class ProfileService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    //TODO need add more fields for edit, here and in the view file
    public function edit($id, ProfileEditForm $form): void
    {
        $user = $this->users->get($id);
        $user->editProfile($form->email, $form->phone);
        $this->users->save($user);
    }
}