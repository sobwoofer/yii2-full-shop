<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.12.17
 * Time: 14:35
 */

namespace core\useCases\manage\Shop;


use core\entities\Shop\Modification\ModificationGroup;
use core\repositories\Shop\ModificationGroupRepository;
use core\forms\manage\Shop\Modification\ModificationGroupForm;
use core\helpers\LangsHelper;

/**
 * Class ModificationGroupManageService
 * @package core\useCases\manage\Shop
 */
class ModificationGroupManageService
{
    public $groups;

    public function __construct(ModificationGroupRepository $groups)
    {
        $this->groups = $groups;
    }

    public function add(ModificationGroupForm $form): void
    {
        $names = [];
        $descriptions = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $group = ModificationGroup::create(
            $form->status,
            $form->slug,
            $form->image,
            $names,
            $descriptions
        );

        if ($form->image) {
            $group->setPhoto($form->image);
        }

        $this->groups->save($group);
    }

    public function edit($id, ModificationGroupForm $form): void
    {
        $group = $this->groups->get($id);

        $names = [];
        $descriptions = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
        }

        $group->edit(
            $form->status,
            $form->slug,
            $form->image,
            $names,
            $descriptions
        );

        if ($form->image) {
            $group->setPhoto($form->image);
        }

        $this->groups->save($group);
    }

    public function remove($id): void
    {
        $group = $this->groups->get($id);
        $this->groups->remove($group);
    }

}