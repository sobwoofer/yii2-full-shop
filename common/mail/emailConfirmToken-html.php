<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.08.17
 * Time: 17:33
 */
use yii\helpers\Html;

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Follow the link below to confirm your email:</p>
    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
