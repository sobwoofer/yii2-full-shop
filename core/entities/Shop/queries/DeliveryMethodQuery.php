<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 16:14
 */


namespace core\entities\Shop\queries;

use yii\db\ActiveQuery;
use omgdef\multilingual\MultilingualTrait;

class DeliveryMethodQuery extends ActiveQuery
{
    use MultilingualTrait;

    public function availableForWeight($weight)
    {
        return $this->andWhere(['and',
            ['or', ['min_weight' => null], ['<=', 'min_weight', $weight]],
            ['or', ['max_weight' => null], ['>=', 'max_weight', $weight]],
        ]);
    }
}