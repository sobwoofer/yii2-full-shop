<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 10:32
 */

namespace backend\controllers\shop;


use core\entities\Shop\ExtraStatus;
use core\readModels\Shop\ExtraStatusReadRepository;
use core\useCases\manage\Shop\ExtraStatusManageService;
use core\forms\manage\Shop\ExtraStatusForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;
use Yii;
use core\repositories\NotFoundException;


class ExtraStatusController extends Controller
{
    public $extraStatuses;
    public $service;

    public function __construct(
        $id,
        $module,
        ExtraStatusReadRepository $extraStatuses,
        ExtraStatusManageService $service,
        array $config = []
    )
    {
        $this->extraStatuses = $extraStatuses;
        $this->service = $service;

        parent::__construct($id, $module, $config);
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
                        'actions' => ['index'],
                        'roles' => [Rbac::PERMISSION_SHOP_EXTRA_STATUS_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_SHOP_EXTRA_STATUS_EDIT],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', ['extraStatuses' => $this->extraStatuses->getAll()]);
    }

    public function actionCreate()
    {
        $form = new ExtraStatusForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->create($form);
                return $this->redirect('index');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', ['model' => $form]);
    }

    public function actionUpdate($id)
    {
        $status = $this->findModel($id);
        $form = new ExtraStatusForm($status);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($id, $form);
                return $this->redirect('index');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', ['model' => $form]);
    }

    public function actionDelete($id)
    {
        $status = $this->findModel($id);
        $this->service->delete($status);
        return $this->redirect('index');
    }

    protected function findModel($id): ExtraStatus
    {
        if (($model = ExtraStatus::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundException('The requested page does not exist.');
    }

}