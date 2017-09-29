<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.09.17
 * Time: 14:34
 */

namespace common\auth;

use core\entities\User\User;
use core\readModels\UserReadRepository;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * Этот клас создан для переноса всех необходимых методов из сущьности User которые производят логин и идентивикацию пользователей
 * а также реализуют интерфейс IdentityInterface. теперь у всех конфигурационных файлах он должен быть указан как
 * identityClass, так же сюда вставлены методы из дополнения OAuth2 для авторизации через API и генерации всех необходимых
 * токенов и ключей.
 *
 * Class Identity
 * @package common\auth
 */
class Identity implements IdentityInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getAuthKey(): string
    {
        return $this->user->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    private static function getRepository(): UserReadRepository
    {
        return \Yii::$container->get(UserReadRepository::class);
    }
}