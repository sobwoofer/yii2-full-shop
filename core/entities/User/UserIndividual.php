<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.01.18
 * Time: 13:55
 */

namespace core\entities\User;


use core\entities\User\queries\UserQuery;
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
class UserIndividual extends User
{
    const TYPE = 2;

    public $first_name;
    public $last_name;
    public $address;
    public $user_id;
    public $type;

    public function __construct(User $user = null, array $config = [])
    {
//        var_dump($user->username);
//        die();
//        $this->user_id = $user->id;
//        $this->username = $user->username;

        parent::__construct($config);
    }


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

//    public static function instantiate($row)
//    {
//        var_dump($row);
//        die();
//    }


//    public static function find(): ActiveQuery
//    {
//        return new UserQuery(get_called_class(), ['type' => self::TYPE, 'tableName' => self::tableName()]);
//    }



    public static function tableName(): string
    {
        return '{{%users_individual}}';
    }

}