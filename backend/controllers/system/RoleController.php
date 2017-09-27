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
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'view'],
//                        'roles' => [Rbac::PERMISSION_BRAND_VIEW],
//                    ],
//                    [
//                        'allow' => true,
//                        'roles' => [Rbac::PERMISSION_BRAND_EDIT],
//                    ],
//                ],
//            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'roles' => $this->service->getRoles(),
            'permissions' =>  $this->service->getPermissions()
        ]);
    }

    private function findModel($userId): User
    {
        if (!$model = User::findOne(['id' => $userId])) {
            throw new Exception('User is not found');
        }
        return $model;
    }

    /**
     * @param $id string - role name
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        if (!$role = $this->service->getRole($id)) {
            throw new NotFoundHttpException('Role is not found ');
        }

        return $this->render('view', [
            'role' => $role,
            'assignUsers' => $this->service->getUsers($role->name),
            'allUsers' => $this->userManageService->getAll(),
            'permissions' => $this->service->getChildRoles($role->name)
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
        return $this->redirect('/system/role', 301);
    }

    public function actionRevoke($userId, $roleName)
    {
        $this->service->revoke($userId, $roleName);
        return $this->redirect('/system/role', 301);
    }


    public function actionEdit()
    {

    }

    public function actionDelete($name, $type)
    {
        $this->service->remove($name, $type);
        return $this->redirect('/system/role', 301);
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
        return $this->redirect('/system/role', 301);
    }


}