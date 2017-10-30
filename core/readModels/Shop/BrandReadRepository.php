<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 9:58
 */

namespace core\readModels\Shop;

use core\entities\Shop\Brand;

class BrandReadRepository
{
    public function find($id): ?Brand
    {
        return Brand::findOne($id);
    }

    public function getAll($limit = null)
    {
        return Brand::find()->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

}

