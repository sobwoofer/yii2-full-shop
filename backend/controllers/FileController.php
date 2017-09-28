<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.09.17
 * Time: 12:43
 */

namespace backend\controllers;


use yii\web\Controller;
use yii\filters\AccessControl;
use core\access\Rbac;


class FileController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => [Rbac::PERMISSION_FILE_VIEW],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}