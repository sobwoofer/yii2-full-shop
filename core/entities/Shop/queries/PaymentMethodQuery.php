<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 25.01.18
 * Time: 14:59
 */

namespace core\entities\Shop\queries;


use core\helpers\LocationHelper;
use omgdef\multilingual\MultilingualTrait;
use yii\db\ActiveQuery;

class PaymentMethodQuery extends ActiveQuery
{
    use MultilingualTrait;

    public function available($id)
    {
        return $this->availableForDelivery($id)->availableWarehouse()->active();
    }

    public function availableForDelivery($id)
    {
        return $this->joinWith('toDeliveryAssignments')->andWhere(['delivery_id' => $id]);
    }

    public function active()
    {
        return $this->andWhere(['active' => 1]);
    }

    public function availableWarehouse()
    {
        return $this->andWhere(['OR',
            ['AND',['warehouse_id' => LocationHelper::getWarehouseId()]],
            ['AND', ['warehouse_id' => null]]
        ]);
    }

}