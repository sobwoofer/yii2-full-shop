<?php

namespace common\bootstrap;

use core\services\ContactService;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use core\cart\Cart;
use core\cart\cost\calculator\SimpleCost;
use core\cart\storage\SessionStorage;
use core\cart\cost\calculator\DynamicCost;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;
use yii\caching\Cache;
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

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(Cart::class, function () {
            return new Cart(
                new SessionStorage('cart', \Yii::$app->session),
                new DynamicCost(new SimpleCost())
            );
        });
    }
}