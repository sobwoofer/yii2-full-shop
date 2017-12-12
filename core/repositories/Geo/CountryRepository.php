<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.12.17
 * Time: 13:07
 */

namespace core\repositories\Geo;


use core\entities\Geo\Country;
use core\repositories\NotFoundException;

class CountryRepository
{
    public function get($id): Country
    {
        if (!$country = Country::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Brand is not found.');
        }
        return $country;
    }

    public function save(Country $country): void
    {
        if (!$country->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Country $country): void
    {
        if (!$country->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}