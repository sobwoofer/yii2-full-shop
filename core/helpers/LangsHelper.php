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
    /**
     * @return array
     */
    public static function getWithSuffix(): array
    {
        $langs = new LangReadRepository();
        $results = [];

        foreach ($langs->findAllActive() as $lang) {
            if ($lang->default === 1) {
                $suffix = '';
            } else {
                $suffix = '_' . $lang->url;
            }

            $results[$suffix] = $lang;
        }
        return $results;
    }

    public static function rules(array $attributes): array
    {
        $results = [];
        foreach ($attributes as $attribute) {
            foreach (self::getWithSuffix()  as $suffix => $lang) {
                $results[] = $attribute . $suffix;
            }
        }


        return $results;
    }


}