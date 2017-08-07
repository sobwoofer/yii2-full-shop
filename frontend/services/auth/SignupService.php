<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 03.08.17
 * Time: 15:18
 */

namespace frontend\services\auth;


use common\entities\User;
use frontend\forms\SignupForm;
use yii\mail\MailerInterface;
use Yii;

class SignupService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function signup(SignupForm $form): User
    {
//        if (User::find()->andWhere(['username' => $form->username])){
//            throw new \DomainException('Username is already exist.');
//        }
//
//        if (User::find()->andWhere(['email' => $form->username])){
//            throw new \DomainException('Email is already exist.');
//        }

        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->save($user);

        $send = $this->mailer
            ->compose(
                ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . Yii::$app->name)
            ->send();
        if (!$send){
            throw new \RuntimeException('Email sending error.');
        }
    }

    public function confirm($token): void
    {
        if(empty($token)) {
            throw new \DomainException('Empty conform token');
        }

        $user = $this->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->save($user);
    }

    private function getByEmailConfirmToken(string $token): User
    {
        if (!$user = User::findOne(['email_confirm_token' => $token])) {
            throw new \DomainException('User is not found');
        }
        return $user;
    }

    private function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

}