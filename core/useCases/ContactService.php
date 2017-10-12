<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.08.17
 * Time: 10:05
 */

namespace core\useCases;

use core\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function send(ContactForm $form): void
    {
        $send = $this->mailer
            ->compose()
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if(!$send) {
            throw new \RuntimeException('Sending error.');
        }
    }

}