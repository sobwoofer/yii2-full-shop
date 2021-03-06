<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 10:53
 */

namespace backend\controllers\shop;


use backend\forms\Shop\StoreSearch;
use core\entities\Shop\Store;
use core\forms\manage\Shop\StoreForm;
use core\repositories\NotFoundException;
use core\useCases\manage\Shop\StoreManageService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;
use core\access\Rbac;
use Yii;

class StoreController extends Controller
{
    private $service;

    public function __construct($id, $module, StoreManageService $service, array $config = [])
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => [Rbac::PERMISSION_SHOP_STORE_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_SHOP_STORE_EDIT],
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
        $searchModel = new StoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'store' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new StoreForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $store = $this->service->create($form);
                return $this->redirect(['view', 'id' => $store->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->getFlash('error', $e->getMessage());
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
        $store = $this->findModel($id);
        $form = new StoreForm($store);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($store->id, $form);
                return $this->redirect(['view', 'id' => $store->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->getFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'store' => $store,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->getFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Store the loaded model
     * @throws NotFoundException if the model cannon be found
     */
    protected function findModel($id): Store
    {
        if (($model = Store::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundException('The requested page does not exist.');
    }


}