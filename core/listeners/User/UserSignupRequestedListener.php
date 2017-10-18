<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.10.17
 * Time: 16:46
 */

namespace core\listeners\User;

use core\useCases\auth\events\UserSignUpRequested;
use yii\mail\MailerInterface;

class UserSignupRequestedListener
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(UserSignUpRequested $event): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $event->user]
            )
            ->setTo($event->user->email)
            ->setSubject('Signup confirm')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }
}