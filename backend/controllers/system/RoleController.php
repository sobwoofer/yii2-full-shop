<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.09.17
 * Time: 12:20
 */

namespace backend\controllers\system;


use core\services\manage\UserManageService;
use core\services\RoleManager;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;
use Yii;
use core\entities\User\User;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

class RoleController extends Controller
{
    private $service;
    private $userManageService;

    public function __construct($id, $module, RoleManager $service, UserManageService $userManageService,  array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->userManageService = $userManageService;
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => [Rbac::PERMISSION_ROLE_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_ROLE_EDIT],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'roles' => $this->service->getRoles(),
            'permissions' =>  $this->service->getPermissions()
        ]);
    }

    /**
     * @param $id string - role name
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $role = $this->service->getRole($id);

        return $this->render('update', [
            'role' => $role,
            'assignUsers' => $this->service->getUsers($role->name),
            'allUsers' => $this->userManageService->getAll(),
            'assignPermissions' => $this->service->getChildren($role->name),
            'permissions' => $this->service->getPermissions(),
        ]);
    }

    public function actionView($id)
    {
        $role = $this->service->getRole($id);

        return $this->render('view', [
            'role' => $role,
            'assignUsers' => $this->service->getUsers($role->name),
            'assignPermissions' => $this->service->getChildren($role->name),
        ]);
    }

    /**
     * @param $userId
     * @param $roleName
     * @return \yii\web\Response
     */
    public function actionAssign($userId, $roleName)
    {
        $user = $this->findModel($userId);
        $this->service->assign($user->id, $roleName);
        return $this->redirect(['index']);
    }

    public function actionRevoke($userId, $roleName)
    {
        $this->service->revoke($userId, $roleName);
        return $this->redirect(['index']);
    }

    public function actionRevokeChild($childName, $parentName)
    {
        $this->service->revokeChild($childName, $parentName);
        return $this->redirect(['index']);
    }


    public function actionAddChild($roleName, $premissionName)
    {
        $this->service->addChild($roleName, $premissionName);
        return $this->redirect(['index']);
    }

    public function actionDelete($name, $type)
    {
        $this->service->remove($name, $type);
        return $this->redirect(['index']);
    }

    /**
     * @param $name
     * @param string $description
     * @param int $type = 1/2 = role/permission
     * @return \yii\web\Response
     */
    public function actionCreate($name, $description = '', $type = 1)
    {
        $this->service->createRole($name, $description, $type);
        return $this->redirect(['index']);
    }


    private function findModel($userId): User
    {
        if (!$model = User::findOne(['id' => $userId])) {
            throw new Exception('User is not found');
        }
        return $model;
    }


}