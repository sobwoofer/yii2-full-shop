<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.12.17
 * Time: 10:10
 */

namespace core\helpers;


use core\entities\Shop\Modification\Modification;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ModificationHelper
{
    public static function statusList(): array
    {
        return [
            Modification::STATUS_DRAFT => 'Draft',
            Modification::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Modification::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Modification::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

}