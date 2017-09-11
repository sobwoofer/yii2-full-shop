<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 12:23
 */

namespace core\entities\Shop\queries;


use yii\db\ActiveQuery;

class DiscountQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }

}