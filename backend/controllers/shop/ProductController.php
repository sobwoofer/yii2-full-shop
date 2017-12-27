<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 12:58
 */

namespace backend\controllers\shop;

use backend\forms\Shop\ModificationAssignmentsSearch;
use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Product\ModificationAssignment;
use core\forms\manage\Shop\Product\ModificationAssignmentsForm;
use core\forms\manage\Shop\Product\PhotosForm;
use core\forms\manage\Shop\Product\Photos360Form;
use core\forms\manage\Shop\Product\ProductCreateForm;
use core\forms\manage\Shop\Product\ProductEditForm;
use core\forms\manage\Shop\Product\RelatedForm;
use core\forms\manage\Shop\Product\BuyWithForm;
use core\useCases\manage\Shop\ProductManageService;
use DeepCopyTest\Matcher\Y;
use Yii;
use core\entities\Shop\Product\Product;
use backend\forms\Shop\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use core\access\Rbac;

class ProductController extends Controller
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
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                    'delete-photo' => ['POST'],
                    'move-photo-up' => ['POST'],
                    'move-photo-down' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => [Rbac::PERMISSION_SHOP_PRODUCT_VIEW],
                    ],
                    [
                        'allow' => true,
                        'roles' => [Rbac::PERMISSION_SHOP_PRODUCT_EDIT],
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
        $searchModel = new ProductSearch();
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
        $product = $this->findModel($id);

        $modificationAssignmentsProvider = new ActiveDataProvider([
            'query' => $product->getModificationAssignments()->joinWith('modification'),
            'pagination' => false,
        ]);


        $photosForm = new PhotosForm();
        $photos360Form = new Photos360Form();
        $relatedForm = new RelatedForm();
        $buyWithForm = new BuyWithForm();
        $modificationAssignmentsForm = new ModificationAssignmentsForm();

        return $this->render('view', [
            'product' => $product,
            'modificationAssignmentsProvider' => $modificationAssignmentsProvider,
            'photosForm' => $photosForm,
            'modificationAssignmentsForm' => $modificationAssignmentsForm,
            'photos360Form' => $photos360Form,
            'relatedForm' => $relatedForm,
            'buyWithForm' => $buyWithForm,
        ]);
    }

    public function actionAddPhotos($id)
    {
        $photos360Form = new PhotosForm();
        $product = $this->findModel($id);
        if ($photos360Form->load(Yii::$app->request->post()) && $photos360Form->validate()) {
            try {
                $this->service->addPhotos($product->id, $photos360Form);
                return $this->redirect(['view', 'id' => $product->id, '#' => 'photos']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

    }

    public function actionAddPhotos360($id)
    {
        $photos360Form = new Photos360Form();
        $product = $this->findModel($id);
        if ($photos360Form->load(Yii::$app->request->post()) && $photos360Form->validate()) {
            try {
                $this->service->addPhotos360($product->id, $photos360Form);
                return $this->redirect(['view', 'id' => $product->id, '#' => 'photos360']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
    }


    //Related product Assignments
    public function actionAddRelated($id)
    {
        $product = $this->findModel($id);
        $form = new RelatedForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->addRelatedProduct($product->id, $form->relatedId);

            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(['view', 'id' => $product->id, '#' => 'relatedProducts']);
    }

    public function actionDeleteRelated($id, $otherId)
    {
        $product = $this->findModel($id);
        try {
            $this->service->removeRelatedProduct($id, $otherId);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['view', 'id' => $product->id, '#' => 'relatedProducts']);
    }

    //Buy with product Assignments
    public function actionAddBuyWith($id)
    {
        $product = $this->findModel($id);
        $form = new BuyWithForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->addBuyWithProduct($product->id, $form->relatedId);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(['view', 'id' => $product->id, '#' => 'buyWithProducts']);
    }

    public function actionDeleteBuyWith($id, $otherId)
    {
        $product = $this->findModel($id);
        try {
            $this->service->removeBuyWithProduct($id, $otherId);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $product->id, '#' => 'buyWithProducts']);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $product = $this->service->create($form);
                return $this->redirect(['view', 'id' => $product->id]);
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
        $product = $this->findModel($id);

        $form = new ProductEditForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
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
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        try {
            $this->service->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->service->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->service->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeletePhoto360($id, $photo_id)
    {
        try {
            $this->service->removePhoto360($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos360']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhotoUp($id, $photo_id)
    {
        $this->service->movePhotoUp($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhoto360Up($id, $photo_id)
    {
        $this->service->movePhoto360Up($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos360']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhotoDown($id, $photo_id)
    {
        $this->service->movePhotoDown($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionMovePhoto360Down($id, $photo_id)
    {
        $this->service->movePhoto360Down($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos360']);
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Product
    {
        if (($model = Product::find()->multilingual()->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
