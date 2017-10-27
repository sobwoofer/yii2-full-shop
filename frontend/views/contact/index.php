<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \core\forms\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7">
                <h2 class="main-title">КОНТАКТЫ</h2>
                <div class="contact-items">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="responsive-img">
                                <img src="images/contacts-1.png" alt="">
                            </div>
                        </div>
                        <div class="col-sm-8 col-xs-12">
                            <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                            <ul>
                                <li>График работы:</li>
                                <li>Ср-Сб: 9 - 18</li>
                                <li>Сб-Вт: выходной</li>
                                <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contact-items">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="responsive-img">
                                <img src="images/contacts-2.png" alt="">
                            </div>

                        </div>
                        <div class="col-sm-8 col-xs-12">
                            <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                            <ul>
                                <li>График работы:</li>
                                <li>Ср-Сб: 9 - 18</li>
                                <li>Сб-Вт: выходной</li>
                                <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="contact_form_wrp">

                    <form action="#" id="feedback">
                        <p class="form-title"><b>Обратная связь</b></p>
                        <p>Пожалуйста, укажите причину обращения</p>
                        <ul>
                            <li><label ><input type="radio" name="feedback">Технический вопрос</label></li>
                            <li><label ><input type="radio" name="feedback">Проблемы с заказом</label></li>
                            <li><label ><input type="radio" name="feedback">Жалоба</label></li>
                            <li><label ><input type="radio" name="feedback">Партнерское предложение</label></li>
                        </ul>
                        <textarea placeholder="Текст сообщения" name="msg"></textarea>
                        <div class="row">

                            <div class="col-md-6">
                                <input type="text" name="firstname" placeholder="Ваше имя">
                                <input type="text" name="phone" placeholder="Телефон">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="email" placeholder="E-mail">
                                <input type="submit" placeholder="lorem">
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="contacts-tabs">
    <div class="container">
        <!-- Nav tabs -->
        <p class="pull-left" style="margin-top: 10px; font-size: 30px;">ДРУГИЕ ПОЗДРАЗДЕЛЕНИЯ КОМПАНИИ ПАПИРУС </p>

        <div class="pull-left contacts-tabs-nav" >
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#kiev" aria-controls="kiev" role="tab" data-toggle="tab">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Киев&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li role="presentation"><a href="#dnepr" aria-controls="dnepr" role="tab" data-toggle="tab">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Днепр&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="kiev">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-items">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 ">
                                    <div class="responsive-img">

                                        <img src="images/contacts-3.png" alt="">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-8 ">
                                    <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                                    <ul>
                                        <li>График работы:</li>
                                        <li>Ср-Сб: 9 - 18</li>
                                        <li>Сб-Вт: выходной</li>
                                        <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-items">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 ">
                                    <div class="responsive-img">

                                        <img src="images/contacts-3.png" alt="">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-8 ">
                                    <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                                    <ul>
                                        <li>График работы:</li>
                                        <li>Ср-Сб: 9 - 18</li>
                                        <li>Сб-Вт: выходной</li>
                                        <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-items">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 ">
                                    <div class="responsive-img">

                                        <img src="images/contacts-3.png" alt="">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-8 ">
                                    <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                                    <ul>
                                        <li>График работы:</li>
                                        <li>Ср-Сб: 9 - 18</li>
                                        <li>Сб-Вт: выходной</li>
                                        <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-items">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 ">
                                    <div class="responsive-img">

                                        <img src="images/contacts-3.png" alt="">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-8 ">
                                    <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                                    <ul>
                                        <li>График работы:</li>
                                        <li>Ср-Сб: 9 - 18</li>
                                        <li>Сб-Вт: выходной</li>
                                        <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="dnepr">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contact-items">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 ">
                                    <div class="responsive-img">

                                        <img src="images/contacts-3.png" alt="">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-8 ">
                                    <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                                    <ul>
                                        <li>График работы:</li>
                                        <li>Ср-Сб: 9 - 18</li>
                                        <li>Сб-Вт: выходной</li>
                                        <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-items">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 ">
                                    <div class="responsive-img">

                                        <img src="images/contacts-3.png" alt="">
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-8 ">
                                    <p class="contact-items-title"><b>Call-center интернет-магазина по вопросам заказа www.papirus.com.ua</b></p>
                                    <ul>
                                        <li>График работы:</li>
                                        <li>Ср-Сб: 9 - 18</li>
                                        <li>Сб-Вт: выходной</li>
                                        <li>Киев телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>Днепр телефон: <a href="tel:+380445037179">+380 44 503 71 79</a></li>
                                        <li>E-mail: <a href="maito:service@papirus.com.ua">service@papirus.com.ua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="google-maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20325.69671712946!2d30.505818324172036!3d50.44646322349638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce5791674ff5%3A0xf04c07850e2acf98!2z0JfQvtC70L7RgtGL0LUg0LLQvtGA0L7RgtCw!5e0!3m2!1sru!2sru!4v1497902473996" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>

</div>

<!--TODO need move under code-->
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
