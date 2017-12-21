<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 11:21
 */

namespace core\useCases\manage\Shop;


use core\repositories\Shop\ExtraStatusRepository;
use core\forms\manage\Shop\ExtraStatusForm;
use core\helpers\LangsHelper;
use core\entities\Shop\ExtraStatus;

class ExtraStatusManageService
{
    public $extraStatuses;

    public function __construct(ExtraStatusRepository $extraStatuses)
    {
        $this->extraStatuses = $extraStatuses;
    }

    public function create(ExtraStatusForm $form)
    {
        $names = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
        }

        $status = ExtraStatus::create($form->externalId, $form->slug, $names);

        $this->extraStatuses->save($status);

        return $status;
    }

    public function edit($id, ExtraStatusForm $form): void
    {
        $status = $this->extraStatuses->get($id);

        $names = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
        }

        $status->edit($form->externalId, $form->slug, $names);

        $this->extraStatuses->save($status);
    }

    public function delete($id): void
    {
        $status = $this->extraStatuses->get($id);
        $this->extraStatuses->remove($status);
    }

}