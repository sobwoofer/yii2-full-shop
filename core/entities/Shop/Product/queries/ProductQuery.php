<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 9:49
 */

namespace core\entities\Shop\Product\queries;

use core\entities\Shop\Product\Product;
use omgdef\multilingual\MultilingualTrait;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    use MultilingualTrait;
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Product::STATUS_ACTIVE,
        ]);
    }
}