<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 12:55
 */

namespace backend\controllers\shop;

use backend\forms\Shop\ModificationGroupSearch;
use core\entities\Shop\Modification\ModificationGroup;
use core\useCases\manage\Shop\ModificationGroupManageService;
use core\forms\manage\Shop\Modification\ModificationGroupForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use core\repositories\NotFoundException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;

class ModificationGroupController extends Controller
{
    private $service;

    public function __construct($id, $module, ModificationGroupManageService $service, $config = [])
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
                        'roles' => [Rbac::PERMISSION_SHOP_MODIFICATION_GROUP_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_SHOP_MODIFICATION_GROUP_EDIT],
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
        $searchModel = new ModificationGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'modificationGroup' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {

        $form = new ModificationGroupForm();
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
        $modificationGroup = $this->findModel($id);
        $form = new ModificationGroupForm($modificationGroup);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($modificationGroup->id, $form);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'modificationGroup' => $modificationGroup,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $modificationGroup = $this->findModel($id);
        try {
            $this->service->remove($modificationGroup->id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return ModificationGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): ModificationGroup
    {
        if (($model = ModificationGroup::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundException('The requested page does not exist.');
    }

}
