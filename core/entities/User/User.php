<?php
namespace core\entities\User;

use core\entities\User\queries\UserQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use core\entities\AggregateRoot;
use core\entities\EventTrait;
use core\entities\User\events\UserSignUpConfirmed;
use core\entities\User\events\UserSignUpRequested;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email_confirm_token
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property integer $status
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property Network[] $networks
 * @property WishlistItem[] $wishlistItems
 */

class User extends ActiveRecord implements AggregateRoot
{
    use EventTrait;

//    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_WAIT = 0;

    const TYPE = null; //admin user, it can be anybody who has asses to admin panel
    const TYPE_ADMIN = 1; //admin user, it can be anybody who has asses to admin panel
    const TYPE_INDIVIDUAL = 2; // it can be anybody individual seller
    const TYPE_COMPANY = 3; // this user group of companies seller

    public $type;
    public $username;
    public $auth_key;
    public $password_hash;
    public $password_reset_token;
    public $email;
    public $email_confirm_token;
    public $status;
    public $created_at;
    public $updated_at;
    public $phone;

    public static function create(string $username = null, string $email, string $phone, string $password, int $type): self
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->phone = $phone;
        $user->setPassword(!empty($password) ? $password : Yii::$app->security->generateRandomString());
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->type = $type;
        $user->auth_key = Yii::$app->security->generateRandomString();
        return $user;
    }

    public function edit(string $username, string $email, string $phone): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = time();
    }

    public function editProfile(string $email, string $phone): void
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->updated_at = time();
    }

    public static function requestSignup(string $username, string $email, string $phone, string $password): self
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->phone = $phone;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status = self::STATUS_WAIT;
        $user->email_confirm_token = Yii::$app->security->generateRandomString();
        $user->generateAuthKey();
        $user->recordEvent(new UserSignUpRequested($user));
        return $user;
    }

    public function confirmSignup(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already active');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm_token = null;
        $this->removeEmailConfirmToken();
        $this->recordEvent(new UserSignUpConfirmed($this));
    }

    public static function signupByNetwork($network, $identity): self
    {
        $user = new User();
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->networks = [Network::create($network, $identity)];
        return  $user;
    }

    public function attachNetwork($network, $identity): void
    {
        $networks = $this->networks;
        foreach ($networks as $current) {
            if ($current->isFor($network, $identity)) {
                throw new \DomainException('Network is already attached');
            }
        }
        $networks[] = Network::create($network, $identity);
        $this->networks = $networks;
    }

    public function addToWishList($productId): void
    {
        $items = $this->wishlistItems;
        foreach ($items as $item) {
            if ($item->isForProduct($productId)) {
                throw new \DomainException('Item is already added.');
            }
        }
        $items[] = WishlistItem::create($productId);
        $this->wishlistItems = $items;
    }

    public function removeFromWishList($productId): void
    {
        $items = $this->wishlistItems;
        foreach ($items as $i => $item) {
            if ($item->isForProduct($productId)) {
                unset($items[$i]);
                $this->wishlistItems = $items;
                return;
            }
        }
        throw new \DomainException('Item is not found.');
    }

    public function requestPasswordReset(): void
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new \DomainException('Passwoed resetting is already requested.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function resetPassword($password): void
    {
        if (empty($this->password_reset_token)) {
            throw new \DomainException('Password resetting is not requested.');
        }
        $this->setPassword($password);
        $this->password_reset_token = null;
    }

    public function isWait()
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getNetworks(): ActiveQuery
    {
        return $this->hasMany(Network::className(), ['user_id' => 'id']);
    }

    public function getWishlistItems(): ActiveQuery
    {
        return $this->hasMany(WishlistItem::class, ['user_id' => 'id']);
    }

//    public function getTypeInfo()
//    {
//        if ($this->type == self::TYPE_COMPANY) {
//            return $this->hasOne(Company::class, ['id' => 'user_id']);
//        } elseif ($this->type == self::TYPE_INDIVIDUAL) {
//            return $this->hasOne(Individual::class, ['id' => 'user_id']);
//        } else {
//            return null;
//        }
//    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    public static function instantiate($row)
    {
        switch ($row['type']) {
            case UserCompany::TYPE:
                return new UserCompany();
            case UserIndividual::TYPE:
                return new UserIndividual();
            default:
                return new static();
        }
    }


//    public static function find(): ActiveQuery
//    {
//
//        return new UserQuery(get_called_class(), []);
//    }

//    public function afterFind()
//    {
////        var_dump($this->username);
////        die();
////        var_dump($this->type);
//
//        switch ($this->type) {
//            case UserCompany::TYPE:
//                return $this->userCompany;
//            case UserIndividual::TYPE:
//                return new UserIndividual($this);
//            default:
//                return new self;
//        }
//    }

    public function getUserIndividual()
    {
        return $this->hasOne(UserIndividual::class, ['user_id' => 'id']);
    }

    public function getUserCompany()
    {
        return $this->hasOne(UserCompany::class, ['user_id' => 'id']);
    }



    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['networks', 'wishlistItems'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }



    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    private function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    private function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    private function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    private function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Generates new email confirm token
     */
//    private function generateEmailConfirmToken()
//    {
//        $this->email_confirm_token = Yii::$app->security->generateRandomString();
//    }

    /**
     * Removes password reset token
     */
    private function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }
}
