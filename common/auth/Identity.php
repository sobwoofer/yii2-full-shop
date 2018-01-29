<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.09.17
 * Time: 14:34
 */

namespace common\auth;

use filsh\yii2\oauth2server\Module;
use OAuth2\Storage\UserCredentialsInterface;
use core\entities\User\User;
use core\readModels\UserReadRepository;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use Yii;

/**
 * Этот клас создан для переноса всех необходимых методов из сущьности User которые производят логин и идентивикацию пользователей
 * а также реализуют интерфейс IdentityInterface. теперь у всех конфигурационных файлах он должен быть указан как
 * identityClass, так же сюда вставлены методы из дополнения OAuth2 для авторизации через API и генерации всех необходимых
 * токенов и ключей. При создании обьекта служит оберткой класса User и возврящает по запросу данные непосредственно
 * из обьекта класса User.
 *
 * Class Identity
 * @package common\auth
 */
class Identity implements IdentityInterface, UserCredentialsInterface
{
    private $user;

    public function __construct(User $user = null)
    {
        $this->user = $user ?? new User();
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $data = self::getOauth()->getServer()->getResourceController()->getToken();
        return !empty($data['user_id']) ? static::findIdentity($data['user_id']) : null;
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getType(): int
    {
        return $this->user->type;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public function checkUserCredentials($username, $password): bool
    {
        if (!$user = self::getRepository()->findActiveByUsername($username)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    public function getUserDetails($username): array
    {
        $user = self::getRepository()->findActiveByUsername($username);
        return ['user_id' => $user->id];
    }

    private static function getRepository(): UserReadRepository
    {
        return \Yii::$container->get(UserReadRepository::class);
    }

    private static function getOauth(): Module
    {
        return Yii::$app->getModule('oauth2');
    }
}