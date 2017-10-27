<?php

namespace common\bootstrap;

use core\services\sms\DummySmsSender;
use core\useCases\ContactService;
use League\Flysystem\Adapter\Ftp;
use League\Flysystem\Filesystem;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use core\cart\Cart;
use core\cart\storage\HybridStorage;
use core\cart\cost\calculator\SimpleCost;
use core\listeners\Shop\Product\ProductSearchPersistListener;
use core\listeners\Shop\Product\ProductSearchRemoveListener;
use core\cart\storage\CookieStorage;
use core\cart\storage\SessionStorage;
use core\dispatchers\DeferredEventDispatcher;
use core\dispatchers\AsyncEventDispatcher;
use core\dispatchers\EventDispatcher;
use core\dispatchers\SimpleEventDispatcher;
use core\jobs\AsyncEventJobHandler;
use core\entities\Shop\Product\events\ProductAppearedInStock;
use core\entities\behaviors\FlySystemImageUploadBehavior;
use core\repositories\events\EntityPersisted;
use core\repositories\events\EntityRemoved;
use core\listeners\User\UserSignupConfirmedListener;
use core\listeners\User\UserSignupRequestedListener;
use core\listeners\Shop\Product\ProductAppearedInStockListener;
use core\listeners\Shop\Category\CategoryPersistenceListener;
use core\services\sms\LoggedSender;
use core\services\newsletter\MailChimp;
use core\services\newsletter\Newsletter;
use core\services\feed\Market;
use core\services\feed\ShopInfo;
use core\services\sms\SmsRu;
use core\services\sms\SmsSender;
use core\entities\User\events\UserSignUpConfirmed;
use core\entities\User\events\UserSignUpRequested;
use core\cart\cost\calculator\DynamicCost;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use yii\di\Container;
use yii\di\Instance;
use yii\caching\Cache;
use yii\rbac\ManagerInterface;
use yii\queue\Queue;
use Yii;
use yiidreamteam\upload\ImageUploadBehavior;

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

        $container->setSingleton(Queue::class, function () use ($app) {
            return $app->get('queue');
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
        $container->setSingleton(EventDispatcher::class, DeferredEventDispatcher::class);

        $container->setSingleton(DeferredEventDispatcher::class, function (Container $container) {
            return new DeferredEventDispatcher(new AsyncEventDispatcher($container->get(Queue::class)));
        });

        $container->setSingleton(SimpleEventDispatcher::class, function (Container $container) {
            return new SimpleEventDispatcher($container, [
                UserSignUpRequested::class => [UserSignupRequestedListener::class],
                UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
                ProductAppearedInStock::class => [ProductAppearedInStockListener::class],
                EntityPersisted::class => [
                    ProductSearchPersistListener::class,
                    CategoryPersistenceListener::class,
                ],
                EntityRemoved::class => [
                    ProductSearchRemoveListener::class,
                    CategoryPersistenceListener::class,
                ],

            ]);
        });

        $container->setSingleton(AsyncEventJobHandler::class, [], [
            Instance::of(SimpleEventDispatcher::class)
        ]);

        //Подключаем библиотеку Flysystem если будем использовать хранение файлов на удаленном сервере
        /*
        $container->setSingleton(Filesystem::class, function () use ($app) {
            return new Filesystem(new Ftp($app->params['ftp']));
        });

        //Заменяем Клас поведения изображений на свой переопределенный для использования стореджа файлов
        //на удаленном сервере через Flysystem
        $container->set(ImageUploadBehavior::class, FlySystemImageUploadBehavior::class);
        */

    }
}