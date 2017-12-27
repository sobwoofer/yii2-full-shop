<?php

namespace core\entities\Shop\Modification;

use core\entities\Shop\Product\ModificationAssignment;
use yii\db\ActiveRecord;
use omgdef\multilingual\MultilingualQuery;
use core\entities\behaviors\FilledMultilingualBehavior;

/**
 * @property integer $id
 * @property string $code
 * @property string $case_code
 * @property string $name
 * @property string $name_ua
 * @property float $price
 * @property integer $manager_id
 * @property integer $group_id
 * @property integer $status
 * @property ModificationGroup $group
 * @property ModificationAssignment[] $modificationAssignments
 */
class Modification extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    public static function create($code, $caseCode, array $names, $price, $managerId, $groupId, $status): self
    {
        $modification = new static();
        $modification->code = $code;
        $modification->case_code = $caseCode;
        $modification->price = $price;
        $modification->manager_id = $managerId;
        $modification->group_id = $groupId;
        $modification->status = $status;

        //$modification->name, $modification->name_ua...
        foreach ($names as $name => $value) {
            $modification->{$name} = $value;
        }

        return $modification;
    }

    public function edit($code, $caseCode, $names, $price, $managerId, $groupId, $status): void
    {
        $this->code = $code;
        $this->case_code = $caseCode;
        $this->price = $price;
        $this->manager_id = $managerId;
        $this->group_id = $groupId;
        $this->status = $status;

        //$modification->name, $modification->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }
    }

//    public function checkout($quantity): void
//    {
//        if ($quantity > $this->quantity) {
//            throw new \DomainException('Only ' . $this->quantity . ' items are available.');
//        }
//        $this->quantity -= $quantity;
//    }

    public function getModificationAssignments()
    {
        return $this->hasMany(ModificationAssignment::class, ['modification_id' => 'id']);
    }

    public function getGroup()
    {
        return $this->hasOne(ModificationGroup::class, ['id' => 'group_id']);
    }
    public function isIdEqualTo($id)
    {
        return $this->id == $id;
    }

    public function isCodeEqualTo($code)
    {
        return $this->code === $code;
    }

    public function behaviors(): array
    {
        return [
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => true,
                'langForeignKey' => 'modification_id',
                'tableName' => '{{%shop_modifications_lang}}',
                'attributes' => [
                    'name'
                ]
            ],
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public static function tableName(): string
    {
        return '{{%shop_modifications}}';
    }
}