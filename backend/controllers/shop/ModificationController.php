<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 12:55
 */

namespace backend\controllers\shop;

use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Modification\ModificationGroup;
use core\forms\manage\Shop\Modification\ModificationForm;
use backend\forms\Shop\ModificationSearch;
use core\useCases\manage\Shop\ModificationManageService;
use Yii;
use core\entities\Shop\Product\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use core\repositories\NotFoundException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;

class ModificationController extends Controller
{
    private $service;

    public function __construct($id, $module, ModificationManageService $service, $config = [])
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
                        'roles' => [Rbac::PERMISSION_SHOP_MODIFICATION_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_SHOP_MODIFICATION_EDIT],
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
        $searchModel = new ModificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * @return mixed
     */
    public function actionGroupIndex()
    {
        $searchModel = new ModificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'modification' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {

        $form = new ModificationForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->add($form);
                return $this->redirect(['index']);
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
        $modification = $this->findModel($id);
        $form = new ModificationForm($modification);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($modification->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'modification' => $modification,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $modification = $this->findModel($id);
        try {
            $this->service->remove($modification->id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Modification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Modification
    {
        if (($model = Modification::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundException('The requested page does not exist.');
    }

    /**
     * @param integer $id
     * @return ModificationGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelGroup($id): ModificationGroup
    {
        if (($model = ModificationGroup::find()->localized()->andWhere(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
