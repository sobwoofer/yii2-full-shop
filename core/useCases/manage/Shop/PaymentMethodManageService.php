<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.01.18
 * Time: 16:02
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\PaymentMethod\PaymentMethod;
use core\forms\manage\Shop\PaymentMethod\PaymentMethodForm;
use core\helpers\LangsHelper;
use core\repositories\Shop\DeliveryMethodRepository;
use core\repositories\Shop\PaymentMethodRepository;

class PaymentMethodManageService
{
    private $paymentMethods;
    private $deliveries;

    public function __construct(PaymentMethodRepository $paymentMethods, DeliveryMethodRepository $deliveries)
    {
        $this->paymentMethods = $paymentMethods;
        $this->deliveries = $deliveries;
    }

    public function create(PaymentMethodForm $form): PaymentMethod
    {
        $names = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $method = PaymentMethod::create(
            $form->warehouseId,
            $form->active,
            $names,
            $descriptions
        );

        foreach ($form->delivery->deliveries as $deliveryId) {
            $delivery = $this->deliveries->get($deliveryId);
            $method->assignDelivery($delivery->id);
        }

        $this->paymentMethods->save($method);
        return $method;

    }

    public function edit($id, PaymentMethodForm $form): void
    {
        $method = $this->paymentMethods->get($id);

        $names = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $method->edit(
            $form->warehouseId,
            $form->active,
            $names,
            $descriptions
        );



        $method->revokeDeliveries();
        $this->paymentMethods->save($method);

        foreach ($form->delivery->deliveries as $deliveryId) {

            $delivery = $this->deliveries->get($deliveryId);
            $method->assignDelivery($delivery->id);
        }

        $this->paymentMethods->save($method);

    }

    public function remove($id): void
    {
        $method = $this->paymentMethods->get($id);
        $this->paymentMethods->remove($method);
    }

}