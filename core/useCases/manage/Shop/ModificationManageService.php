<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 14:48
 */

namespace core\useCases\manage\Shop;

use core\entities\Shop\Modification\Modification;
use core\forms\manage\Shop\Modification\ModificationForm;
use core\repositories\Shop\ModificationRepository;
use core\helpers\LangsHelper;


/**
 * Class ModificationManageService
 * @package core\useCases\manage\Shop
 */
class ModificationManageService
{
    public $modifications;

    public function __construct(ModificationRepository $modifications)
    {
        $this->modifications = $modifications;
    }

    public function add(ModificationForm $form): void
    {
        $names = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
        }

        $modification = Modification::create(
            $form->code,
            $form->caseCode,
            $names,
            $form->price,
            $form->managerId,
            $form->groupId,
            $form->status
        );

        $this->modifications->save($modification);
    }

    public function edit($id, ModificationForm $form): void
    {
        $names = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
        }

        $modification = $this->modifications->get($id);
        $modification->edit(
            $form->code,
            $form->caseCode,
            $names,
            $form->price,
            $form->managerId,
            $form->groupId,
            $form->status
        );

        $this->modifications->save($modification);
    }

    public function remove($id): void
    {
        $modification = $this->modifications->get($id);
        $this->modifications->save($modification);
    }
}