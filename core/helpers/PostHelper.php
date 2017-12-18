<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.09.17
 * Time: 11:48
 */


namespace core\helpers;

use core\entities\Shop\Product\ExtraStatus;
use core\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PostHelper
{
    public static function statusList(): array
    {
        return [
            Product::STATUS_DRAFT => 'Draft',
            Product::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function externalStatusList(): array
    {
        return [
            Product::EXTERNAL_STATUS_NOT_AVAILABLE => 'Not available',
            Product::EXTERNAL_STATUS_ARE_AVAILABLE => 'Are available',
            Product::EXTERNAL_STATUS_EXPECTED => 'Expected',
        ];
    }

    public static function extraStatusList(): array
    {
        return ArrayHelper::map(ExtraStatus::find()->all(), 'id', 'name');
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function externalStatusName($status): string
    {
        return ArrayHelper::getValue(self::externalStatusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function externalStatusLabel($status): string
    {
        switch ($status) {
            case Product::EXTERNAL_STATUS_NOT_AVAILABLE:
                $class = 'label label-danger';
                break;
            case Product::EXTERNAL_STATUS_ARE_AVAILABLE:
                $class = 'label label-success';
                break;
            case Product::EXTERNAL_STATUS_EXPECTED:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::externalStatusList(), $status), [
            'class' => $class,
        ]);
    }
}