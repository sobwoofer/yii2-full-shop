<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.09.17
 * Time: 15:29
 */

namespace console\controllers;

use core\entities\User\User;
use core\services\manage\UserManageService;
use Yii;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\ArrayHelper;

/**
 * Interactive console roles manager
 */
class RoleController extends Controller
{
    private $service;

    public function __construct($id, $module, UserManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Adds role to user
     */
    public function actionAssign(): void
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $user = $this->findModel($username);
        $role = $this->select('Role:', ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'));
        $this->service->assignRole($user->id, $role);
        $this->stdout('Done!' . PHP_EOL);
    }

    private function findModel($username): User
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('User is not found');
        }
        return $model;
    }


    public function actionCreateRole()
    {
        $am = Yii::$app->authManager;
        $role = $this->prompt('New role name:', ['required' => true]);

        if ($am->getRole($role)){
            throw new Exception('Role already exist');
        }
        $description = $this->prompt('Role description:');

        $newRole = $am->createRole($role);
        $newRole->description = $description;
        $am->add($newRole);

        $this->stdout('Role: '. $role . ' is created' . PHP_EOL);

    }

    public function actionCreatePermission()
    {
        $am = Yii::$app->authManager;
        $permission = $this->prompt('New permission name:', ['required' => true]);

        if ($am->getPermission($permission)){
            throw new Exception('Permission already exist');
        }
        $description = $this->prompt('Permission description:');

        $newRole = $am->createPermission($permission);
        $newRole->description = $description;
        $am->add($newRole);

        $this->stdout('Permission: '. $permission . ' is created' . PHP_EOL);

    }

    public function actionAddPermissionToRole()
    {
        $am = Yii::$app->authManager;

        $roleName = $this->select('Enter role name:', ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'));

        if (!$role = $am->getRole($roleName)){
            throw new Exception('Role not found');
        }

        $permissionName = $this->select('Enter permission name:', ArrayHelper::map(Yii::$app->authManager->getPermissions(), 'name', 'description'));

        if (!$permission = $am->getPermission($permissionName)){
            throw new Exception('Permission not found');
        }

        $am->addChild($role, $permission);


        $this->stdout('permission : '. $permission->name . ' added to role: ' . $role->name . PHP_EOL);

    }

}