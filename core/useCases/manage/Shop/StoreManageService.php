<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 13.12.17
 * Time: 10:37
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\Store;
use core\forms\manage\Shop\StoreForm;
use core\repositories\Shop\StoreRepository;
use core\helpers\LangsHelper;
use core\repositories\Shop\GivePointRepository;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

class StoreManageService
{
    private $stores;
    private $givePoints;

    public function __construct(StoreRepository $stores, GivePointRepository $givePoints)
    {
        $this->stores = $stores;
        $this->givePoints = $givePoints;
    }

    public function create(StoreForm $form)
    {
        $names = [];
        $addresses = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $addresses['address' . $suffix] = $form->{'address' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $store = Store::create(
            $form->cityId,
            $form->phone,
            $form->email,
            $form->workWeekdays,
            $form->workWeekend,
            $form->slug ?: Inflector::slug($form->name),
            $names,
            $addresses,
            $descriptions
        );

        if ($form->photo) {
            $store->setPhoto($store->photo);
        }

        $this->stores->save($store);

        return $store;
    }

    public function edit($id, StoreForm $form)
    {
        $names = [];
        $addresses = [];
        $descriptions = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $addresses['address' . $suffix] = $form->{'address' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $store = $this->stores->get($id);
        $store->edit(
            $form->cityId,
            $form->phone,
            $form->email,
            $form->workWeekdays,
            $form->workWeekend,
            $form->slug ?: Inflector::slug($form->name),
            $names,
            $addresses,
            $descriptions
        );



        if ($form->photo) {
            $store->setPhoto($form->photo);
        }

        $this->stores->save($store);
    }

    public function remove($id): void
    {
        $store = $this->stores->get($id);
        if ($this->givePoints->existByStore($store->id)) {
            throw new \DomainException('Unable to remove brand with Give Points.');
        }
        $this->stores->remove($store);
    }

}