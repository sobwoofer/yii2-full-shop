<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.01.18
 * Time: 13:55
 */

namespace core\entities\User;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class Individual
 * @package core\entities\User
 * @property string $first_name
 * @property integer $id
 * @property integer $user_id
 * @property string $last_name
 * @property string $address
 * @property string $username
 * @property User $user
 */
class UserIndividual extends ActiveRecord
{
    const TYPE = 2;

    public $type;

    public function init()
    {
        $this->type = self::TYPE;
        parent::init();
    }

    public function beforeSave($insert)
    {
        $this->type = self::TYPE;
        return parent::beforeSave($insert);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public static function tableName(): string
    {
        return '{{%users_individual}}';
    }

}