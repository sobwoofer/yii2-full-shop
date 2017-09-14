<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.09.17
 * Time: 15:24
 */

namespace core\controllers\payment;



use core\entities\Shop\Order\Order;
use core\readModels\Shop\OrderReadRepository;
use core\services\Shop\OrderService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use robokassa\Merchant;
//use robokassa\ResultAction;
//use robokassa\SuccessAction;
//use robokassa\FailAction;

/**
 * Test payment controller, for example was robokassa
 * Class TestPaymentController
 * @package core\controllers\payment
 */
class RobokassaController extends Controller
{
    public $enableCsrfValidation = false;

    private $orders;
    private $service;

    public function __construct($id, $module, OrderReadRepository $orders, OrderService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->orders = $orders;
        $this->service = $service;
    }

    public function actionInvoice($id)
    {
        $order = $this->loadModel($id);

        return $this->getMerchant()->payment($order->cost, $order->id, 'Payment', null, null);
    }

    /**
     * Description result process and fail actions after redirect of payment system
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'result' => [
                'class' => ResultAction::class,
                'callback' => [$this, 'resultCallback'],
            ],
            'success' => [
                'class' => SuccessAction::class,
                'callback' => [$this, 'successCallback'],
            ],
            'fail' => [
                'class' => FailAction::class,
                'callback' => [$this, 'failCallback'],
            ],
        ];
    }

    public function successCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        return $this->goBack();
    }

    public function resultCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $order = $this->loadModel($nInvId);
        try {
            $this->service->pay($order->id);
            return 'OK' . $nInvId;
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    public function failCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $order = $this->loadModel($nInvId);
        try {
            $this->service->fail($order->id);
            return 'OK' . $nInvId;
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    private function loadModel($id): Order
    {
        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $order;
    }

    private function getMerchant(): Merchant
    {
        return Yii::$app->get('robokassa');
    }

}