<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.01.18
 * Time: 13:54
 */

namespace core\entities\User;


use core\entities\User\queries\UserQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;

/**
 * Class Company
 * @package core\entities\User
 * @property int $id
 * @property int $user_id
 * @property string $company_name
 * @property string $company_tax_code
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property User $user
 */
class UserCompany extends ActiveRecord
{
    const TYPE = 3;

    public $type;

    public function init()
    {
        $this->type = self::TYPE;
        parent::init();
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }


    public static function tableName(): string
    {
        return '{{%users_company}}';
    }

}