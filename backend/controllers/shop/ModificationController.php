<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 12:55
 */

namespace backend\controllers\shop;

use core\forms\manage\Shop\Product\ModificationForm;
use core\services\manage\Shop\ProductManageService;
use Yii;
use core\entities\Shop\Product\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;

class ModificationController extends Controller
{
    private $service;

    public function __construct($id, $module, ProductManageService $service, $config = [])
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
        return $this->redirect('shop/product');
    }

    /**
     * @param $product_id
     * @return mixed
     */
    public function actionCreate($product_id)
    {
        $product = $this->findModel($product_id);

        $form = new ModificationForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->addModification($product->id, $form);
                return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param integer $product_id
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($product_id, $id)
    {
        $product = $this->findModel($product_id);
        $modification = $product->getModification($id);

        $form = new ModificationForm($modification);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->editModification($product->id, $modification->id, $form);
                return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'product' => $product,
            'model' => $form,
            'modification' => $modification,
        ]);
    }

    /**
     * @param $product_id
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->removeModification($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
