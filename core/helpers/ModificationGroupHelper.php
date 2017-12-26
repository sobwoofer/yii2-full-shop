<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 26.12.17
 * Time: 11:28
 */

namespace core\helpers;


use core\entities\Shop\Modification\ModificationGroup;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ModificationGroupHelper
{
    public static function statusList(): array
    {
        return [
            ModificationGroup::STATUS_DRAFT => 'Draft',
            ModificationGroup::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case ModificationGroup::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case ModificationGroup::STATUS_ACTIVE:
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