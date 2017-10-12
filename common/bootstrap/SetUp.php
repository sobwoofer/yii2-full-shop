<?php

namespace common\bootstrap;

use core\services\ContactService;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use core\cart\Cart;
use core\cart\storage\HybridStorage;
use core\cart\cost\calculator\SimpleCost;
use core\cart\storage\CookieStorage;
use core\cart\storage\SessionStorage;
use core\services\feed\Market;
use core\services\feed\ShopInfo;
use core\cart\cost\calculator\DynamicCost;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use yii\caching\Cache;
use yii\rbac\ManagerInterface;
use Yii;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(Cart::class, function () use ($app) {
            return new Cart(
                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
                new DynamicCost(new SimpleCost())
            );
        });

        $container->setSingleton(Market::class, [], [
            new ShopInfo($app->name, $app->name, $app->params['frontendHostInfo']),
        ]);
    }
}