<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.09.17
 * Time: 12:20
 */

namespace backend\controllers\system;


use core\services\manage\UserManageService;
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

    public function __construct($id, $module, UserManageService $service,  array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
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
            'roles' => Yii::$app->authManager->getRoles(),
            'permissions' => Yii::$app->authManager->getPermissions()
        ]);
    }

    public function actionView($name)
    {
        if (!$role = Yii::$app->authManager->getRole($name)) {
            throw new NotFoundHttpException('Role is not found ');
        }



        return $this->render('view', [
            'role' => Yii::$app->authManager->getRoles(),
            'permissions' => Yii::$app->authManager->getPermissions()
        ]);
    }

    private function findModel($userId): User
    {
        if (!$model = User::findOne(['id' => $userId])) {
            throw new Exception('User is not found');
        }
        return $model;
    }

    public function actionAssign($userId, $roleName)
    {
        $user = $this->findModel($userId);
        $role = Yii::$app->authManager->getRole($roleName);

        $this->service->assignRole($user->id, $role);

    }


    public function actionEdit()
    {

    }

    public function actionDelete()
    {

    }

    public function actionCreate()
    {

    }


}