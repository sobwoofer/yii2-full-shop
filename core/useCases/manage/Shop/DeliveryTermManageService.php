<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:21
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\DeliveryTerm;
use core\forms\manage\Shop\DeliveryTermForm;
use core\repositories\Shop\DeliveryTermRepository;
use core\helpers\LangsHelper;

class DeliveryTermManageService
{
    public $deliveryTerms;

    public function __construct(DeliveryTermRepository $deliveryTerms)
    {
        $this->deliveryTerms = $deliveryTerms;
    }

    public function create(DeliveryTermForm $form)
    {
        $names = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
        }

        $term = DeliveryTerm::create($form->externalId, $form->slug, $form->value, $names);

        $this->deliveryTerms->save($term);

        return $term;
    }

    public function edit($id, DeliveryTermForm $form): void
    {
        $term = $this->deliveryTerms->get($id);

        $names = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
        }

        $term->edit($form->externalId, $form->slug, $form->value, $names);

        $this->deliveryTerms->save($term);
    }

    public function delete($id): void
    {
        $term = $this->deliveryTerms->get($id);
        $this->deliveryTerms->remove($term);
    }

}