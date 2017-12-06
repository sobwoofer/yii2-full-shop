<?php

namespace core\useCases\manage\Shop;

use core\entities\Shop\Characteristic\Characteristic;
use core\forms\manage\Shop\CharacteristicForm;
use core\repositories\Shop\CharacteristicRepository;
use core\helpers\LangsHelper;

class CharacteristicManageService
{
    private $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicForm $form): Characteristic
    {
        $names = [];
        $variants = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $variants['variants' . $suffix] = $form->variants->{$suffix};
        }

        $characteristic = Characteristic::create(
            $names,
            $variants,
            $form->type,
            $form->required,
            $form->default,
            $form->sort
        );
        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    public function edit($id, CharacteristicForm $form): void
    {
        $characteristic = $this->characteristics->get($id);
        $names = [];
        $variants = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $variants['variants' . $suffix] = $form->variants->{$suffix};
        }

        $characteristic->edit(
            $names,
            $variants,
            $form->type,
            $form->required,
            $form->default,
            $form->sort
        );
        $this->characteristics->save($characteristic);
    }

    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }
}