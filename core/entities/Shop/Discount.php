<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.09.17
 * Time: 12:21
 */

namespace core\entities\Shop;

use core\entities\Shop\queries\DiscountQuery;
use yii\db\ActiveRecord;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * @property integer $id
 * @property integer $percent
 * @property float $max_cost
 * @property float $min_cost
 * @property string $description
 * @property string $description_ua
 * @property string $name
 * @property string $name_ua
 * @property string $from_date
 * @property string $to_date
 * @property bool $active
 * @property integer $sort
 */
class Discount extends ActiveRecord
{
    public static function create($percent, $names, $descriptions, $fromDate, $toDate, $sort, $minCost, $maxCost): self
    {
        $discount = new static();
        $discount->percent = $percent;
        $discount->from_date = $fromDate;
        $discount->to_date = $toDate;
        $discount->sort = $sort;
        $discount->min_cost = $minCost;
        $discount->max_cost = $maxCost;
        $discount->active = true;

        //$this->$name, $this->$name_ua...
        foreach ($names as $name => $value) {
            $discount->{$name} = $value;
        }
        //$this->$description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $discount->{$name} = $value;
        }

        return $discount;
    }

    public function edit($percent, $names, $descriptions, $fromDate, $toDate, $sort, $minCost, $maxCost): void
    {
        $this->percent = $percent;
        $this->from_date = $fromDate;
        $this->to_date = $toDate;
        $this->sort = $sort;
        $this->min_cost = $minCost;
        $this->max_cost = $maxCost;

        //$this->$name, $this->$name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }
        //$this->$description, $this->$description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    public function isEnabled(): bool
    {
        return true;
    }

    public function isRightCostDiapason($cost)
    {
        return ($this->min_cost ? $cost > $this->min_cost : true) && ($this->max_cost ? $cost < $this->max_cost : true);
    }

    public static function tableName(): string
    {
        return '{{%shop_discounts}}';
    }

    public static function find(): DiscountQuery
    {
        return new DiscountQuery(static::class);
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'discount_id',
                'tableName' => '{{%shop_discounts_lang}}',
                'attributes' => [ 'name', 'description']
            ],
        ];
    }

}