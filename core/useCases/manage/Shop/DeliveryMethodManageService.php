<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:17
 */

namespace core\useCases\manage\Shop;

use core\entities\Shop\DeliveryMethod\DeliveryMethod;
use core\forms\manage\Shop\DeliveryMethodForm;
use core\repositories\Shop\DeliveryMethodRepository;
use core\helpers\LangsHelper;

class DeliveryMethodManageService
{
    private $methods;

    public function __construct(DeliveryMethodRepository $methods)
    {
        $this->methods = $methods;
    }

    public function create(DeliveryMethodForm $form): DeliveryMethod
    {

        $names = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $method = DeliveryMethod::create(
            $names,
            $descriptions,
            $form->cost,
            $form->minWeight,
            $form->maxWeight,
            $form->sort
        );
        $this->methods->save($method);
        return $method;
    }

    public function edit($id, DeliveryMethodForm $form): void
    {
        $names = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $method = $this->methods->get($id);
        $method->edit(
            $names,
            $descriptions,
            $form->cost,
            $form->minWeight,
            $form->maxWeight,
            $form->sort
        );
        $this->methods->save($method);
    }

    public function remove($id): void
    {
        $method = $this->methods->get($id);
        $this->methods->remove($method);
    }
}