<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 9:08
 */

namespace frontend\controllers\shop;

use core\cart\Cart;
use core\forms\Shop\AddToCartForm;
use core\readModels\Shop\ProductReadRepository;
use core\useCases\Shop\CartService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use core\forms\Shop\Order\OrderForm;

class CartController extends Controller
{
    public $layout = 'blank';

    private $products;
    private $service;
    private $cart;

    public function __construct($id, $module, CartService $service, Cart $cart, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->service = $service;
        $this->cart = $cart;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'quantity' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $cart = $this->service->getCart();
        $form = new OrderForm($this->cart->getWeight());

        return $this->render('index', [
            'cart' => $cart,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAdd($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->layout = 'blank';

        $form = new AddToCartForm($product);


        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                //if product does not have any modifications that will add him to cart and return
                if (!$product->modificationAssignments) {
                    $this->service->add($product->id, null, $form->quantity);
                } else {
                    $this->service->add($product->id, $form->modifications, $form->quantity);
                }

                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

//        if (!$product->modificationAssignments) {
//            try {
//                $this->service->add($product->id, null, 1);
//                Yii::$app->session->setFlash('success', 'Success!');
//                return $this->redirect(Yii::$app->request->referrer);
//            } catch (\DomainException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error', $e->getMessage());
//            }
//        }







        return $this->render('add', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionQuantity($id)
    {
        try {
            $this->service->set($id, (int)Yii::$app->request->post('quantity'));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionRemove($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

}