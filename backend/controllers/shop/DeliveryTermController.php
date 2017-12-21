<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 10:29
 */

namespace backend\controllers\shop;


use core\entities\Shop\DeliveryTerm;
use core\forms\manage\Shop\DeliveryTermForm;
use core\readModels\Shop\DeliveryTermReadRepository;
use core\useCases\manage\Shop\DeliveryTermManageService;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;
use core\repositories\NotFoundException;
use Yii;

class DeliveryTermController extends Controller
{
    public $deliveryTerms;
    public $service;

    public function __construct(
        $id,
        $module,
        DeliveryTermReadRepository $deliveryTerms,
        DeliveryTermManageService $service,
        array $config = []
    )
    {
        $this->deliveryTerms = $deliveryTerms;
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
                        'roles' => [Rbac::PERMISSION_SHOP_DELIVERY_TERM_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_SHOP_DELIVERY_TERM_EDIT],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', ['deliveryTerms' => $this->deliveryTerms->getAll()]);
    }

    public function actionCreate()
    {
        $form = new DeliveryTermForm();

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
        $term = $this->findModel($id);
        $form = new DeliveryTermForm($term);

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


    protected function findModel($id): DeliveryTerm
    {
        if (($model = DeliveryTerm::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundException('The requested page does not exist.');
    }



}