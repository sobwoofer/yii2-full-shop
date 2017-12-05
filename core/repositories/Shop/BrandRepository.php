<?php

namespace core\repositories\Shop;

use core\entities\Shop\Brand\Brand;
use core\repositories\NotFoundException;

class BrandRepository
{
    public function get($id): Brand
    {
        if (!$brand = Brand::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Brand is not found.');
        }
        return $brand;
    }

    public function save(Brand $brand): void
    {
        if (!$brand->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Brand $brand): void
    {
        if (!$brand->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}