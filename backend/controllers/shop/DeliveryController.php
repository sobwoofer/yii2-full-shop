<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:09
 */

namespace backend\controllers\shop;

use core\forms\manage\Shop\DeliveryMethodForm;
use core\services\manage\Shop\DeliveryMethodManageService;
use Yii;
use core\entities\Shop\DeliveryMethod;
use backend\forms\Shop\DeliveryMethodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;

class DeliveryController extends Controller
{
    private $service;

    public function __construct($id, $module, DeliveryMethodManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
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
                        'roles' => [Rbac::PERMISSION_DELIVERY_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_DELIVERY_EDIT],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliveryMethodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'method' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new DeliveryMethodForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $method = $this->service->create($form);
                return $this->redirect(['view', 'id' => $method->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $method = $this->findModel($id);

        $form = new DeliveryMethodForm($method);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($method->id, $form);
                return $this->redirect(['view', 'id' => $method->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'method' => $method,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return DeliveryMethod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): DeliveryMethod
    {
        if (($model = DeliveryMethod::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
