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

    public function revokeChild($childName, $parentName): void
    {
        $perent = $this->getRole($parentName);
        $child = $this->getPermission($childName);

        if (! $this->manager->removeChild($perent, $child)) {
            throw new \DomainException('Role "' . $child->name . '" did not revoke from' . $perent->name);
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
    public function getChildren($name): array
    {
        if (!$roleChildren = $this->manager->getChildren($name)) {
            throw new \DomainException('Role ' . $name . ' does not has children.');
        }
        return $roleChildren;
    }

    public function addChild($parentName, $childName): void
    {
        $parent = $this->getRole($parentName);
        $child = $this->getPermission($childName);

        if (!$this->manager->addChild($parent, $child)) {
            throw new \DomainException('Child ' . $child->name . ' did not added to');
        }

    }

    public function getPermission($name)
    {
        if (!$permission = $this->manager->getPermission($name)){
            throw new \DomainException('Permission is not found');
        }
        return $permission;
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
            $role = $this->getRole($name);
        } else {
            $role = $this->getPermission($name);
        }
        $this->manager->remove($role);
    }

}