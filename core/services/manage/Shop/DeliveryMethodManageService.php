<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:17
 */

namespace core\services\manage\Shop;

use core\entities\Shop\DeliveryMethod;
use core\forms\manage\Shop\DeliveryMethodForm;
use core\repositories\Shop\DeliveryMethodRepository;

class DeliveryMethodManageService
{
    private $methods;

    public function __construct(DeliveryMethodRepository $methods)
    {
        $this->methods = $methods;
    }

    public function create(DeliveryMethodForm $form): DeliveryMethod
    {
        $method = DeliveryMethod::create(
            $form->name,
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
        $method = $this->methods->get($id);
        $method->edit(
            $form->name,
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