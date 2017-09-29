<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.09.17
 * Time: 11:53
 */


namespace api\controllers;

use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionIndex(): array
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
