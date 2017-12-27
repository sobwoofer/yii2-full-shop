<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.12.17
 * Time: 17:22
 */

namespace backend\controllers\shop;


use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Modification\ModificationGroup;
use core\entities\Shop\Product\ModificationAssignment;
use core\forms\manage\Shop\Product\ModificationAssignmentsForm;
use core\useCases\manage\Shop\ProductManageService;
use DeepCopyTest\Matcher\Y;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;
use core\entities\Shop\Product\Product;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;

class ModificationAssignController extends Controller
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

    public function actionCreate($id)
    {
        $product = $this->findProductModel($id);

        $form = new ModificationAssignmentsForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->addModificationAssign($product->id, $form);
                return $this->redirect(['/shop/product/view', 'id'=> $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', ['model' => $form, 'product' => $product]);

    }

    public function actionUpdate($product_id, $modification_id)
    {
        $product = $this->findProductModel($product_id);
        $modification = $this->findModificationModel($modification_id);
        $modificationAssign = $this->findModel($product->id, $modification->id);

        $form = new ModificationAssignmentsForm($modificationAssign);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->editModificationAssign($product->id, $form);
                return $this->redirect(['/shop/product/view', 'id'=> $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', ['model' => $form, 'product' => $product, 'modification' => $modification]);
    }

    public function actionDelete($product_id, $modification_id)
    {
        try {
            $this->service->removeModificationAssign($product_id, $modification_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['/shop/product/view', 'id' => $product_id, '#' => 'modifications']);
    }

    public function actionGetModificationsOfGroupId($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $modifications = ArrayHelper::map(Modification::find()->localized()->andWhere(['group_id' => $id])->all(), 'id', 'name');
            return ['success' => true, 'modifications' => $modifications];
        }

        return ['oh no' => 'you are not allowed :('];
    }

    /**
     * @param integer $productId
     * @param integer $modificationId
     * @return ModificationAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($productId, $modificationId): ModificationAssignment
    {
        if (($model = ModificationAssignment::find()
                ->andWhere(['product_id' => $productId, 'modification_id' => $modificationId])
                ->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($id): Product
    {
        if (($model = Product::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param integer $id
     * @return Modification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModificationModel($id): Modification
    {
        if (($model = Modification::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}