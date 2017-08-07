<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.08.17
 * Time: 13:16
 */

/* @var $this yii\web\View */
/* @var $user common\entities\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
