<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.12.17
 * Time: 16:22
 */

namespace core\helpers;


use core\entities\Shop\Product\ModificationAssignment;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class ModificationAssignmentHelper
{
    public static function statusList(): array
    {
        return [
            ModificationAssignment::STATUS_DRAFT => 'Draft',
            ModificationAssignment::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case ModificationAssignment::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case ModificationAssignment::STATUS_ACTIVE:
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