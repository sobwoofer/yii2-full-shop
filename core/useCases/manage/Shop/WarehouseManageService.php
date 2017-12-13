<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:37
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\GivePoint;
use core\entities\Shop\Warehouse;
use core\repositories\Shop\WarehouseRepository;
use core\forms\manage\Shop\WarehouseForm;
use core\helpers\LangsHelper;
use core\repositories\Shop\GivePointRepository;
use yii\helpers\Inflector;

class WarehouseManageService
{
    private $warehouses;
    private $givePoints;

    public function __construct(WarehouseRepository $warehouses, GivePointRepository $givePoints)
    {
        $this->warehouses = $warehouses;
        $this->givePoints = $givePoints;
    }

    public function create(WarehouseForm $form)
    {
        $names = [];
        $addresses = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $addresses['address' . $suffix] = $form->{'address' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $warehouse = Warehouse::create($form->cityId, $form->minOrder, $form->slug, $names, $addresses, $descriptions);

        $this->warehouses->save($warehouse);

        return $warehouse;
    }

    public function edit($id, WarehouseForm $form)
    {
        $names = [];
        $addresses = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $addresses['address' . $suffix] = $form->{'address' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $warehouse = $this->warehouses->get($id);
        $warehouse->edit(
            $form->cityId,
            $form->minOrder,
            $form->slug ?: Inflector::slug($form->name),
            $names,
            $addresses,
            $descriptions
        );
        $this->warehouses->save($warehouse);
    }

    public function remove($id): void
    {
        $warehouse = $this->warehouses->get($id);
        if ($this->givePoints->existByWarehouse($warehouse->id)) {
            throw new \DomainException('Unable to remove brand with Give Points.');
        }
        $this->warehouses->remove($warehouse);
    }

}