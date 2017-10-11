<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 11.10.17
 * Time: 15:18
 */

namespace frontend\controllers;

use core\entities\Shop\Product\Product;
use core\services\feed\Market;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class FeedController extends Controller
{
    private $generator;

    public function __construct($id, $module, Market $generator, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->generator = $generator;
    }

    public function actionIndex(): Response
    {
        $xml = \Yii::$app->cache->getOrSet('yandex-market', function () {
            return $this->generator->generate(function (Product $product) {
                return Url::to(['/shop/catalog/product', 'id' => $product->id], true);
            });
        });

        return \Yii::$app->response->sendContentAsFile($xml, 'yandex-market.xml', [
            'mimeType' => 'application/xml',
            'inline' => true,
        ]);
    }
}