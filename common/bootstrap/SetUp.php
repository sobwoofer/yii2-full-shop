<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 02.08.17
 * Time: 10:09
 */

namespace common\bootstrap;

use function foo\func;
use frontend\services\auth\PasswordResetService;
use frontend\services\contact\ContactService;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use yii\base\BootstrapInterface;
use yii\di\Instance;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

//        $container->setSingleton(PasswordResetService::class);

        $container->setSingleton(MailerInterface::class, function() use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

//        $container->setSingleton(PasswordResetService::class, function() use ($app) {
//           return new PasswordResetService([$app->params['supportEmail'] => $app->name . ' robot']);
//        });

    }

}