<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 02.11.17
 * Time: 10:26
 */

namespace frontend\widgets\auth;

use Yii;
use yii\base\Widget;
use core\forms\auth\LoginForm;

class LoginWidget extends Widget
{
    public function run()
    {
        if (Yii::$app->user->isGuest){
            $form = new LoginForm();

            return $this->render('login-form', ['model' => $form]);
        }
        return null;
    }

}