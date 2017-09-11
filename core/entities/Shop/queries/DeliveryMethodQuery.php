<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:14
 */


namespace shop\entities\Shop\queries;

use yii\db\ActiveQuery;

class DeliveryMethodQuery extends ActiveQuery
{
    public function availableForWeight($weight)
    {
        return $this->andWhere(['and',
            ['or', ['min_weight' => null], ['<=', 'min_weight', $weight]],
            ['or', ['max_weight' => null], ['>=', 'max_weight', $weight]],
        ]);
    }
}