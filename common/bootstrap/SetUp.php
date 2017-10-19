<?php

namespace common\bootstrap;

use core\services\sms\DummySmsSender;
use core\useCases\ContactService;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use core\cart\Cart;
use core\cart\storage\HybridStorage;
use core\cart\cost\calculator\SimpleCost;
use core\cart\storage\CookieStorage;
use core\cart\storage\SessionStorage;
use core\dispatchers\EventDispatcher;
use core\dispatchers\SimpleEventDispatcher;
use core\listeners\User\UserSignupConfirmedListener;
use core\listeners\User\UserSignupRequestedListener;
use core\services\sms\LoggedSender;
use core\services\newsletter\MailChimp;
use core\services\newsletter\Newsletter;
use core\services\feed\Market;
use core\services\feed\ShopInfo;
use core\services\sms\SmsRu;
use core\services\sms\SmsSender;
use core\useCases\auth\events\UserSignUpConfirmed;
use core\useCases\auth\events\UserSignUpRequested;
use core\cart\cost\calculator\DynamicCost;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use yii\di\Container;
use yii\caching\Cache;
use yii\rbac\ManagerInterface;
use Yii;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        //фреймворковский контейнер, дальше внедряем в него зависимости
        $container = \Yii::$container;

        //Подключение билдера Еластик Серча для генерации и импорта JSON(а)
        $container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });

        //Подключение фреймворковского мейлера из приложения $app
        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        //Подключение компонента кеширования
        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        //Подключение менеджера RBAC ролей пользователей
        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        //Подключение Сервиса обратной связи и передача ему почты из конфига
        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        //Подключение корзины и указание параметров куда писать пользовательскую корзину
        $container->setSingleton(Cart::class, function () use ($app) {
            return new Cart(
                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
                new DynamicCost(new SimpleCost())
            );
        });

        //Подключение генерации xml фида данных для сервисов типа хотлайн и тп.
        $container->setSingleton(Market::class, [], [
            new ShopInfo($app->name, $app->name, $app->params['frontendHostInfo']),
        ]);

        //Подключение сервиса почтовой подписки на рассылку
        $container->setSingleton(Newsletter::class, function () use ($app) {
            return new MailChimp(
                new \DrewM\MailChimp\MailChimp($app->params['mailChimpKey']),
                $app->params['mailChimpListId']
            );
        });

        //Подключение смс рассылщика
        $container->setSingleton(SmsSender::class, function () use ($app) {
            return new LoggedSender(
                new SmsRu($app->params['smsRuKey']),
                \Yii::getLogger()
            );
        });

        //Подключение обработчика событий
        $container->setSingleton(EventDispatcher::class, function (Container $container) {
            return new SimpleEventDispatcher($container, [
                UserSignUpRequested::class => [UserSignupRequestedListener::class],
                UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
            ]);
        });
    }
}