<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 16:27
 */

namespace frontend\bootstrap;

use core\services\location\storage\SessionStorage;
use core\services\location\LocationManager;
use yii\base\BootstrapInterface;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\widgets\Breadcrumbs;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        //Подключение LocationManager определения местаположения и отображения параметров товара в зависимости
        $container->setSingleton(LocationManager::class, function () use ($app) {
            return new LocationManager(new SessionStorage('location', new Session()));
        });


        $container->set(Breadcrumbs::class, function ($container, $params, $args) {
            return new Breadcrumbs(ArrayHelper::merge([
                'homeLink' => [
                    'label' => '<i class="fa fa-home"></i>',
                    'encode' => false,
                    'url' => \Yii::$app->homeUrl,
                ],
            ], $args));
        });
    }
}