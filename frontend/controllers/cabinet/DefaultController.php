<?php

namespace frontend\controllers\cabinet;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    'allow' => true,
                    'roles' => '@'
                ],
            ],
        ];
    }
}