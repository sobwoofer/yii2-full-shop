<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 15:20
 */

namespace frontend\controllers\shop;


use yii\web\Controller;

class CatalogController extends Controller
{
    public $layout = 'catalog';

    public function actionIndex()
    {
        return $this->render('index');
    }

}