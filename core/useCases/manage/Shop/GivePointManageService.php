<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:37
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\GivePoint;
use core\forms\manage\Shop\GivePointForm;
use core\repositories\Shop\StoreRepository;
use core\repositories\Shop\WarehouseRepository;
use core\helpers\LangsHelper;
use core\repositories\Shop\GivePointRepository;
use yii\helpers\Inflector;

class GivePointManageService
{
    private $stores;
    private $warehouses;
    private $givePoints;

    public function __construct(
        WarehouseRepository $warehouses,
        GivePointRepository $givePoints,
        StoreRepository $stores
        )
    {
        $this->warehouses = $warehouses;
        $this->stores = $stores;
        $this->givePoints = $givePoints;
    }

    public function create(GivePointForm $form)
    {
        $names = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $givePoint = GivePoint::create(
            $form->warehouseId,
            $form->storeId,
            $form->slug ?: Inflector::slug($form->name),
            $names,
            $descriptions
        );

        $this->givePoints->save($givePoint);

        return $givePoint;
    }

    public function edit($id, GivePointForm $form)
    {
        $names = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $givePoint = $this->givePoints->get($id);
        $givePoint->edit(
            $form->warehouseId,
            $form->storeId,
            $form->slug ?: Inflector::slug($form->name),
            $names,
            $descriptions
        );
        $this->givePoints->save($givePoint);
    }

    public function remove($id): void
    {
        $givePoint = $this->givePoints->get($id);
        $this->givePoints->remove($givePoint);
    }

}