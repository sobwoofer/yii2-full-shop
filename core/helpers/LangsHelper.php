<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 28.11.17
 * Time: 17:58
 */

namespace core\helpers;


use core\readModels\LangReadRepository;
use Yii;

class LangsHelper
{
    public static function getSuffix()
    {
        $langs = new LangReadRepository();
        $results = [];
        foreach ($langs->findAllActive() as $lang) {
            if ($lang->default === 1) {
                $suffix = '';
            } else {
                $suffix = '_' . $lang->url;
            }
            $results[] = $lang;
        }

        return $results;

    }

}