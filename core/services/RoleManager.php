<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.09.17
 * Time: 13:45
 */


namespace core\services;

use core\repositories\UserRepository;
use yii\rbac\ManagerInterface;
use yii\rbac\Role;
use yii\web\NotFoundHttpException;

class RoleManager
{
    private $manager;
    private $users;

    public function __construct(ManagerInterface $manager, UserRepository $users)
    {
        $this->manager = $manager;
        $this->users = $users;
    }

    public function assign($userId, $name): void
    {
        $am = $this->manager;
        if (!$role = $am->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        $am->revokeAll($userId);
        $am->assign($role, $userId);
    }

    public function revoke($userId, $name): void
    {
        $role = $this->getRole($name);
        if (!$this->manager->revoke($role, $userId)) {
            throw new \DomainException('Role "' . $name . '" did not revoke');
        }
    }

    /**
     * @param $name
     * @return Role
     */
    public function getRole($name): Role
    {
        if (!$role = $this->manager->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        return $role;
    }

    public function getRoles(): array
    {
        if (!$roles = $this->manager->getRoles()) {
            throw new \DomainException('Roles do not found.');
        }
        return $roles;
    }

    public function getPermissions(): array
    {
        if (!$permissions = $this->manager->getPermissions()) {
            throw new \DomainException('Permissions do not found.');
        }
        return $permissions;
    }

    public function getUsers($name)
    {
       return $this->users->findByAuthAssignment($name);
    }

    /**
     * @param $name
     * @return Role[]
     */
    public function getChildRoles($name): array
    {
        if (!$roleChildren = $this->manager->getChildRoles($name)) {
            throw new \DomainException('Role ' . $name . ' does not has children.');
        }
        return $roleChildren;
    }

    public function createRole($name, $description, $type): void
    {
        if ($type == 1) {
            if ($this->manager->getRole($name)){
                throw new \DomainException('Role already exist');
            }
            $role = $this->manager->createRole($name);
        } else {
            if ($this->manager->getPermission($name)){
                throw new \DomainException('Permission already exist');
            }
            $role = $this->manager->createPermission($name);
        }

        $role->description = $description;
        $this->manager->add($role);
    }

    public function remove($name, $type): void
    {
        if ($type == 1) {
           if (!$role =  $this->manager->getRole($name)) {
                throw new NotFoundHttpException('Role is not exist');
           }
        } else {
            if (!$role =  $this->manager->getPermission($name)) {
                throw new NotFoundHttpException('Permission is not exist');
            }
        }
        $this->manager->remove($role);
    }

}