<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.09.17
 * Time: 9:21
 */

namespace core\readModels\Shop;

use core\entities\Shop\Order\Order;
use yii\data\ActiveDataProvider;

class OrderReadRepository
{
    public function getOwm($userId): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Order::find()
                ->andWhere(['user_id' => $userId])
                ->orderBy(['id' => SORT_DESC]),
            'sort' => false,
        ]);
    }

    public function findOwn($userId, $id): ?Order
    {
        return Order::find()->andWhere(['user_id' => $userId, 'id' => $id])->one();
    }
}