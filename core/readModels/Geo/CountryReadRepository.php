<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.12.17
 * Time: 13:11
 */

namespace core\readModels\Geo;

use core\entities\Geo\Country;

class CountryReadRepository
{
    public function find($id): ?Country
    {
        return Country::findOne($id);
    }

    public function getAll($limit = null)
    {
        return Country::find()->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

}