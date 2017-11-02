<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\auth\SignupForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="registration-page">
    <div class="container">
        <div class="row">
            <div class="row">

                <div class="col-sm-10 col-sm-offset-1">

                    <h1 class="main-title"><?= Html::encode($this->title) ?></h1>
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Физическое лицо</a></li>
                            <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Юридическое лицо</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab-1">

                                <div class="col-sm-6">
                                    <div class="registration-page-box-title">
                                        <p>Зарегистрироваться на сайте</p>
                                    </div>
                                    <div class="box">

                                        <?php $form = ActiveForm::begin(['id' => 'user-signup']); ?>
                                            <?= $form->field($model, 'username')
                                                ->textInput(['autofocus' => true, 'placeholder' => 'Login'])
                                                ->label(false) ?>
                                            <?= $form->field($model, 'email')
                                                ->textInput(['autofocus' => true, 'placeholder' => 'Email'])
                                                ->label(false) ?>
                                            <?= $form->field($model, 'phone')
                                                ->textInput(['autofocus' => true, 'placeholder' => '(XXX) XXX-XX-XX'])
                                                ->label(false) ?>
                                            <?= $form->field($model, 'password')
                                                ->passwordInput(['autofocus' => true, 'placeholder' => 'Password'])
                                                ->label(false) ?>
                                            <?= Html::input('submit', 'Signup',null, ['class' => 'btn', 'name' => 'signup-button']) ?>

<!--                                                TODO need add user type and implement there all under fields-->
<!--                                            <input type="text" placeholder="Ваше имя">-->
<!--                                            <input type="text" placeholder="Почта">-->
<!--                                            <input type="text" placeholder="Пароль">-->
<!--                                            <input type="text" placeholder="Повтор пароля">-->
<!--                                            <input type="text" placeholder="Телефон">-->
<!--                                            <input type="text" placeholder="Адрес доставки">-->
<!--                                                <input type="submit" value="Зарегистрироваться" class="btn">-->
                                        <?php ActiveForm::end(); ?>
                                    </div>

                                    <p class="agreement">Регистрируясь, вы соглашаетесь с
                                        <?= Html::a('пользовательским соглашением', '/page/3', ['target' => '_blank']) ?></p>

                                </div>


                                <div class="col-sm-6">
                                    <div class="registration-page-box-title">
                                        <p>Войти c помощью <br>
                                            аккаунта в социальных сетях
                                        </p>
                                    </div>
                                    <div class="box">
                                        <?= \frontend\widgets\auth\SocialAuthWidget::widget([
                                            'baseAuthUrl' => ['auth/network/auth']
                                        ]); ?>
                                        <p class="agreement">
                                            Регистрируясь через соц. сети вы не предоставляете <br>
                                            доступ к своему аккаунту - он остается в безопасности.
                                        </p>
                                    </div>

                                </div>


                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab-2">

                                <div class="box" style="max-width: 370px; margin: 0 auto;">
                                    <?php $form = ActiveForm::begin(['id' => 'company-signup', 'options' => ['autocomplete' => 'off']]); ?>
                                    <?= $form->field($model, 'username')
                                        ->textInput(['autofocus' => true, 'placeholder' => 'Login'])
                                        ->label(false) ?>
                                    <?= $form->field($model, 'email')
                                        ->textInput(['autofocus' => true, 'placeholder' => 'Email'])
                                        ->label(false) ?>
                                    <?= $form->field($model, 'phone')
                                        ->textInput(['autofocus' => true, 'placeholder' => '(XXX) XXX-XX-XX'])
                                        ->label(false) ?>
                                    <?= $form->field($model, 'password')
                                        ->passwordInput(['autofocus' => true, 'placeholder' => 'Password'])
                                        ->label(false) ?>
                                    <?= Html::input('submit', 'Signup',null, ['class' => 'btn', 'name' => 'signup-button']) ?>

<!--                                  TODO need add user type and implement there all under fields-->
<!--                                    <input type="text" placeholder="Ваше имя">-->
<!--                                        <input type="text" placeholder="Организация">-->
<!--                                        <input type="text" placeholder="ЕДРПО">-->
<!--                                        <input type="text" placeholder="Почта">-->
<!--                                        <input type="text" placeholder="Пароль">-->
<!--                                        <input type="text" placeholder="Повтор пароля">-->
<!---->
<!--                                        <input type="submit" value="Зарегистрироваться" class="btn">-->
                                    <?php ActiveForm::end() ?>
                                </div>
                                <p class="agreement">Регистрируясь, вы соглашаетесь с <a href="#">пользовательским соглашением</a></p>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>