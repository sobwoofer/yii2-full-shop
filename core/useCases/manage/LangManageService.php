<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.11.17
 * Time: 11:58
 */

namespace core\useCases\manage;


use core\entities\Lang;
use core\forms\manage\LangForm;
use core\repositories\LangRepository;

class LangManageService
{
    private $langs;

    public function __construct(LangRepository $langs)
    {
        $this->langs = $langs;
    }

    public function create(LangForm $form): Lang
    {
        $lang = Lang::create(
            $form->url,
            $form->locale,
            $form->name,
            $form->default,
            $form->status
        );
        $this->langs->save($lang);
        return $lang;
    }

    public function edit($id, LangForm $form): Lang
    {
        $lang = $this->langs->get($id);
        $lang->edit(
            $form->url,
            $form->locale,
            $form->name,
            $form->default,
            $form->status
        );
        $this->langs->save($lang);
        return $lang;
    }

    public function remove($id): void
    {
        $lang = $this->langs->get($id);
        $this->langs->remove($lang);
    }

}