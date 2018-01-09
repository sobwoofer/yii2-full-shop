<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 12:23
 */

namespace core\entities\Shop\queries;


use omgdef\multilingual\MultilingualTrait;
use yii\db\ActiveQuery;

class DiscountQuery extends ActiveQuery
{
    use MultilingualTrait;

    public function active()
    {
        return $this->andWhere(['active' => true]);
    }

}