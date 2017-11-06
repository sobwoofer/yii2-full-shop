<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.11.17
 * Time: 11:33
 */

namespace backend\controllers\shop;


use backend\forms\Shop\ReviewSearch;
use core\entities\Shop\Product\Product;
use core\forms\manage\Shop\Product\ReviewEditForm;
use core\useCases\manage\Shop\ReviewManageService;
use yii\web\Controller;
use yii\filters\VerbFilter;
use core\access\Rbac;
use yii\filters\AccessControl;
use Yii;
use yii\web\NotFoundHttpException;

class ReviewController extends Controller
{
    private $service;

    public function __construct($id, $module, ReviewManageService $service, $config = [])
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
                        'roles' => [Rbac::PERMISSION_PRODUCT_REVIEW_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_PRODUCT_REVIEW_EDIT],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
        ]);

    }

    public function actionUpdate($product_id, $id)
    {
        $product = $this->findModel($product_id);
        $review = $product->getReview($id);

        $form = new ReviewEditForm($review);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product->id, $review->id, $form);
                $this->redirect(['view', 'product_id' => $product->id, 'id' => $review->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }
        return $this->render('update', [
            'product' => $product,
            'model' => $form,
            'review' => $review,
            ]);
    }

    public function actionView($product_id, $id)
    {
        $product = $this->findModel($product_id);
        $review = $product->getReview($id);

        return $this->render('view',[
            'product' => $product,
            'review' => $review,
        ]);

    }

    public function actionActivate($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->activate($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        $this->redirect(['view', 'product_id' => $product->id, 'id' => $id]);
    }

    public function actionDelete($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->remove($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}