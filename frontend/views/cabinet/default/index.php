<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="profile-content">
    <h1 class="main-title uppercase"><?= Html::encode($this->title) ?></h1>

    <div class="row">

        <div class="col-sm-7">

            <div class="box" >
                <form action="">
                    <input type="text" placeholder="Константин Иванович">
                    <input type="text" placeholder="kostantin@ukr.net">
                    <input type="text" placeholder="(029) 353-29-64">
                    <input type="text" placeholder="Телефон №2">
                    <input type="text" placeholder="Киев">
                    <input type="text" placeholder="ул. Вольная, 32/47">
                    <input type="text" placeholder="Старый пароль">
                    <input type="text" placeholder="Новый пароль">
                    <input type="text" placeholder="Повтор пароля">
                    <input type="submit" value="Сохранить" class="btn">

                </form>

            </div>
            <br>
            <p class="text-center">У Вас активно <b>345 бонусов</b>, использовать до 31.12.2017</p>

        </div>

        <div class="col-sm-4 col-sm-offset-1">

            <div class="box">
                <div class="profile-wrp">
                    <div class="profile-img-wrp responsive-img circle-img">
                        <img src="//placehold.it/250x250" alt="">
                    </div>
                    <p class="profile-title text-center"> <b>Ваш менеджер Анна</b></p>

                    <p class="mailto"> <i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:anna@gmail.com">anna@gmail.com</a></p>
                    <p class="tel"> <i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+30987654321">(098) 765-43-21</a></p>
                </div>
            </div>
        </div>
        <?= yii\authclient\widgets\AuthChoice::widget([
            'baseAuthUrl' => ['cabinet/network/attach'],
        ]); ?>
    </div>

</div>
<div class="clearfix"></div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


