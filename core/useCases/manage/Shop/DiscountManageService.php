<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.01.18
 * Time: 17:04
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\Discount;
use core\repositories\Shop\DiscountRepository;
use core\forms\manage\Shop\DiscountForm;
use core\helpers\LangsHelper;

class DiscountManageService
{
    public $discounts;

    public function __construct(DiscountRepository $discounts)
    {
        $this->discounts = $discounts;
    }

    public function create(DiscountForm $form)
    {
        $names = [];
        $descriptions = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $discount = Discount::create(
            $form->percent,
            $names,
            $descriptions,
            $form->fromDate,
            $form->toDate,
            $form->sort,
            $form->minCost,
            $form->maxCost
        );

        $this->discounts->save($discount);

        return $discount;
    }

    public function edit($id, DiscountForm $form): void
    {
        $discount = $this->discounts->get($id);

        $names = [];
        $descriptions = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $discount->edit(
            $form->percent,
            $names,
            $descriptions,
            $form->fromDate,
            $form->toDate,
            $form->sort,
            $form->minCost,
            $form->maxCost
        );

        $this->discounts->save($discount);
    }

    public function delete($id): void
    {
        $discount = $this->discounts->get($id);
        $this->discounts->remove($discount);
    }

}