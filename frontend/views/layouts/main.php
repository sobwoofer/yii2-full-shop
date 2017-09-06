<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 9:16
 */

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\jquery\formstyler\FormStylerAsset;
use yii\helpers\Url;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add Favicon ico
    <link rel="apple-touch-icon" href="/fav16.png">
    <link rel="apple-touch-icon" sizes="32x32" href="/fav32.png">
    <link rel="apple-touch-icon" sizes="96x96" href="/fav96.png">
    <link rel="icon" type="image/png" href="/fav16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/fav32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/fav96.png" sizes="96x96"> -->

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- ADD STYLE -->

    <!-- Normalize
    <link rel="stylesheet" href="libs/normalize-css/normalize.css"> -->
    <!-- Hamburgers -->
    <!-- <link rel="stylesheet" href="libs/css-hamburgers/dist/hamburgers.min.css"> -->
    <!-- Font Awesome -->
<!--    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">-->
    <!-- Slick Carousel -->
    <!-- <link rel="stylesheet" href="libs/slick-carousel/slick/slick.css"> -->
    <!-- <link rel="stylesheet" href="libs/slick-carousel/slick/slick-theme.css"> -->

    <!-- Bootstrap -->

<!--    <link rel="stylesheet" href="libs/jquery-ui/jquery-ui.min.css">-->
<!--    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="libs/selectric/selectric.css">-->
<!--    <link rel="stylesheet" href="libs/swiper/css/swiper.min.css">-->
<!--    <link rel="stylesheet" href="libs/jquery.mmenu/jquery.mmenu.all.css">-->

<!--    <link rel="stylesheet" href="libs/jQueryFormStyler/dist/jquery.formstyler.css">-->
<!--    <link rel="stylesheet" href="libs/jQueryFormStyler/dist/jquery.formstyler.theme.css">-->

    <!-- Theme Bootstrap
    <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap-theme.min.css"> -->

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- Less/Sass generated style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Yandex.Metrika counter -->
    <!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter -->
    <!-- /Google Analytics counter -->
</head>

<?php $this->beginBody() ?>
<body>
<header role="banner">

    <!-- .top-nav -->
    <div class="fix_menu_wrp">
        <ul>
            <li><a href="./about-us.html">about-us.html</a></li>
            <li><a href="./article.html">article.html</a></li>
            <li><a href="./cart.html">cart.html</a></li>
            <li><a href="./catalog.html">catalog.html</a></li>
            <li><a href="./categories.html">categories.html</a></li>
            <li><a href="./comments.html">comments.html</a></li>
            <li><a href="./contacts.html">contacts.html</a></li>
            <li><a href="./featured.html">featured.html</a></li>
            <li><a href="./help.html">help.html</a></li>
            <li><a href="./orders.html">orders.html</a></li>
            <li><a href="./news-page.html">news-page.html</a></li>
            <li><a href="./pay_deliver.html">pay_deliver.html</a></li>
            <li><a href="./index.html">index.html</a></li>
            <li><a href="./preposition.html">preposition.html</a></li>
            <li><a href="./search_page.html">search.html</a></li>
            <li><a href="./registration.html">registration.html</a></li>
            <li><a href="./profile-page.html">profile.html</a></li>
            <li><a href="./discounts.html">discounts.html</a></li>
            <li><a href="./one-product.html">one-product.html</a></li>
        </ul>
    </div>
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <ul class="top-nav__info-menu">
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Контакты</a></li>
                        <li><a href="#">Новости</a></li>
                        <li><a href="#">Оплата и доставка</a></li>
                        <li><a href="#">Помощь</a></li>
                        <li><a href="#">$ Система скидок</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-2 pull-right">
                    <select name="#" id="">
                        <option value="1">Киев</option>
                        <option value="2">Харьков</option>
                        <option value="3">Одесса</option>
                        <option value="5">Запорожье</option>
                        <option value="6">Львов</option>
                        <option value="7">Хмельницкий</option>
                        <option value="9">Северодонецк</option>
                    </select>
                </div>
                <div class="col-xs-12 col-md-2 col-lg-1 pull-right">
                    <!-- .lang-btn -->
                    <div class="lang">
                        <span class="ua">укр</span>
                        <div class="lang-btn">
                            <input type="checkbox" value="None" id="lang-btn" name="check" checked/>
                            <label for="lang-btn"></label>
                        </div>
                        <span class="ru act">рус</span>
                    </div>
                    <!-- end .lang-btn -->
                </div>
            </div>
        </div>
    </div>
    <!-- end top-nav -->
    <!-- .top-info -->
    <div class="top-info">
        <div class="container">
            <div class="row">
                <div class="flex-btw-center">
                    <div class="col-xs-12 col-md-5 col-lg-4">
                        <div class="top-logo-block">
                            <a href="<?= Url::home() ?>">
                                <div class="logo">
                                    <img src="/images/system/logo-papirus.png" alt="">
                                </div>
                            </a>

                            <div class="top-logo-info">
                                <p>Интернет-магазин</p>
                                <p>Все для офiсу</p>
                                <p>более 15 000 товаров</p>
                            </div>
                            <div class="claerfix"></div>
                        </div>
                    </div>
                    <!-- end .md3 -->
                    <div class="col-xs-12 col-md-5">
                        <div class="advantages">
                            <img src="/images/system/car-icon.png" alt="">
                            <p>Собственый
                                <br>автопарк</p>
                            <p><img src="/images/system/header-arrow.png" alt=""> </p>
                            <p class="number">120</p>
                            <p>Разногабаритных автомобилей
                                <br> для быстрой доставки</p>
                        </div>
                    </div>
                    <!-- end md5 -->
                    <div class="col-xs-12 col-md-3 col-lg-2">
                        <div class="working-hours">
                            <p>время работы:
                                <br> с 9.00 до 18.00</p>
                        </div>
                    </div>
                    <!-- end md2 -->
                    <div class="col-xs-12 col-md-3 col-lg-2 ">
                        <div class="top-telephone">
                            <select name="#" id="">
                                <option value="#"><a href="tel:093-000-00-01">093-000-00-01</a></option>
                                <option value="#"><a href="tel:093-000-00-02">093-000-00-02</a></option>
                                <option value="#"><a href="tel:093-000-00-03">093-000-00-03</a></option>
                                <option value="#"><a href="tel:093-000-00-04">093-000-00-04</a></option>
                                <option value="#"><a href="tel:093-000-00-05">093-000-00-05</a></option>
                            </select>
                        </div>
                    </div>
                    <!-- end md-2 -->
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-2">
                    <div class="catalog active">
                        <!--<div class="catalog active">-->
                        <button class="catalog-btn"><i>Каталог</i> <span></span></button>
                        <ul class="menu">
                            <li class="menu__item">
                                <a class="menu__link" href="#">Бумага и изделия из бумаги</a>
                                <ul class="sub_menu">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="sub_menu__title" href="#">Бумага офисная</a>
                                            <a class="sub_menu__title" href="#">Конверты</a>
                                            <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                                <ul class="menu menu_flat">
                                                    <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                                    <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                                </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="sub_menu__title" href="#">Бумага офисная</a>
                                            <a class="sub_menu__title" href="#">Конверты</a>
                                            <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                                <ul class="menu menu_flat">
                                                    <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                                    <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                                </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="sub_menu__title" href="#">Бумага офисная</a>
                                            <a class="sub_menu__title" href="#">Конверты</a>
                                            <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                                <ul class="menu menu_flat">
                                                    <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                                    <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                                </ul>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Письменные принадлежности</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Офисные принадлежности</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Принадлежности для делопроизводства</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Упаковочные материалы</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Презентационное оборудование</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Офисная техника</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Компьютерная техника</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Бытовая техника</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Хозяйственные товары</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Продовольственные товары</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Мебель для офиса</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Деловые подарки</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Бумага и изделия из бумаги</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Бумага и изделия из бумаги</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu__item">
                                <a class="menu__link" href="#">Бумага и изделия из бумаги</a>
                                <ul class="sub_menu">
                                    <a class="sub_menu__title" href="#">Бумага офисная</a>
                                    <a class="sub_menu__title" href="#">Конверты</a>
                                    <li class="menu__item"><a class="sub_menu__link" href="#">Бухгалтерская документация</a>
                                        <ul class="menu menu_flat">
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские бланки</a></li>
                                            <li class="menu__item"><a class="menu__link menu__link_flat" href="#">Бухгалтерские книги</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- end .catalog -->
                </div>
                <!-- end md2 -->
                <div class="col-xs-12 col-md-4 col-lg-5">
                    <div class="top-search-block">
                        <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>
                            <input type="text" name="text" value="" id="serach-input" placeholder="Что ищете?">
                            <input type="submit" value=" ">
                        <?= Html::endForm() ?>


                        <div class="top-serch-block--result">
                            <div class="serch-row">

                                <div class="col-sm-2">
                                    <div class="top-serch-block--result-img">
                                        <img src="http://placehold.it/40x40" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-5 name-wrp">
                                    <a href="#">Lorem ipsum dolor sit.</a>
                                </div>
                                <div class="col-sm-2 price-wrp">
                                    <span class="price">2.83 грн</span>
                                </div>
                                <div class="col-sm-3 add-wrp">
                                    <a href="#" class="add uppercase">в корзину</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="serch-row">

                                <div class="col-sm-2">
                                    <div class="top-serch-block--result-img">
                                        <img src="http://placehold.it/40x40" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-5 name-wrp">
                                    <a href="#">Lorem ipsum dolor sit.</a>
                                </div>
                                <div class="col-sm-2 price-wrp">
                                    <span class="price">2.83 грн</span>
                                </div>
                                <div class="col-sm-3 add-wrp">
                                    <a href="#" class="add uppercase">в корзину</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="serch-row">

                                <div class="col-sm-2">
                                    <div class="top-serch-block--result-img">
                                        <img src="http://placehold.it/40x40" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-5 name-wrp">
                                    <a href="#">Lorem ipsum dolor sit.</a>
                                </div>
                                <div class="col-sm-2 price-wrp">
                                    <span class="price">2.83 грн</span>
                                </div>
                                <div class="col-sm-3 add-wrp">
                                    <a href="#" class="add uppercase">в корзину</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="serch-row">

                                <div class="col-sm-2">
                                    <div class="top-serch-block--result-img">
                                        <img src="http://placehold.it/40x40" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-5 name-wrp">
                                    <a href="#">Lorem ipsum dolor sit.</a>
                                </div>
                                <div class="col-sm-2 price-wrp">
                                    <span class="price">2.83 грн</span>
                                </div>
                                <div class="col-sm-3 add-wrp">
                                    <a href="#" class="add uppercase">в корзину</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="serch-row">

                                <div class="col-sm-2">
                                    <div class="top-serch-block--result-img">
                                        <img src="http://placehold.it/40x40" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-5 name-wrp">
                                    <a href="#">Lorem ipsum dolor sit.</a>
                                </div>
                                <div class="col-sm-2 price-wrp">
                                    <span class="price">2.83 грн</span>
                                </div>
                                <div class="col-sm-3 add-wrp">
                                    <a href="#" class="add uppercase">в корзину</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>






                            <p class="all-result"> Все результаты поиска (20)</p>

                        </div>


                    </div>
                </div>
                <!-- end md6 -->
                <div class="col-xs-12 col-md-5 col-lg-5">
                    <div class="top-action">
                        <div class="authorization" data-toggle="modal" data-target="#authorization_modal">
                            <p><span></span>
                                <i>
                                    <?php if (Yii::$app->user->isGuest): ?>
                                        <a href="#">Войти/регистрация</a>
                                    <?php else: ?>
                                        <a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>" data-method="post">Выход</a>
                                    <?php endif; ?>
                                </i>
                            </p>
                        </div>




                        <!-- Modal -->
                        <div class="modal fade" id="authorization_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <form action="#">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="E-mail">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Пароль">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label >
                                                        <input type="checkbox">
                                                        Запомнить пароль
                                                    </label>

                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn-link forget" >Забыли пароль?</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn enter" >Войти</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn-link reg" >Зарегестрироваться</button>
                                                </div>
                                            </div>

                                        </form>

                                        <ul class="soc-reg">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                                                    Google+
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                                                    Facebook
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <hr>
                        <div class="header_cart_wrp">

                            <div class="cart cart_empty">
                                <span class="cart__icon"></span>
                                <p class="cart__title">Корзина</p>
                                <p class="cart-items">ПОКА ПУСТА</p>
                            </div>
                            <div class="cart cart_full">
                                <span class="cart__icon cart__icon_full"> <span>100</span> </span>
                                <p class="cart__title">Корзина</p>
                                <p class="cart__amount">15.000.00 грн</p>
                            </div>
                        </div>

                        <div class="checkout btn">
                            оформить
                        </div>
                        <div class="cart__inside">
                            <div class="cart__item">
                                <p class="cart__product-icon"></p>
                                <div class="wrapper">
                                    <p class="cart__product-name">Папка на завязках "Дело"</p>
                                    <div class="wrapper_product">
                                        <p class="cart__product-price">2.83 грн</p>
                                        <p class="cart__product-amount">1 шт</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cart__item">
                                <p class="cart__product-icon"></p>
                                <div class="wrapper">
                                    <p class="cart__product-name">Папка на завязках "Дело"</p>
                                    <div class="wrapper_product">
                                        <p class="cart__product-price">2.83 грн</p>
                                        <p class="cart__product-amount">1 шт</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end top-nav -->
    <div class="mob-menu">
        <div class="menu">
            <button><i class="fa fa-bars fa-2x"></i><span>МЕНЮ</span></button>
            <div class="menu-inner">
                <ul>
                    <li><a href="#">О компании</a></li>
                    <li><a href="#">Корзина</a></li>
                    <li><a href="#">Акции</a></li>
                    <li><a href="#">Войти</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">Оплата и доставка</a></li>
                    <li><a href="#">Помощь</a></li>
                    <li><a href="#">$ Система скидок</a></li>
                </ul>
            </div>
        </div>
        <div class="catalog">
            <button>Каталог</button>
            <div class="catalog-inner">
                <ul>
                    <ul>
                        <li>
                            <a href="#">Бумага и изделия из бумаги</a>
                        </li>
                        <li>
                            <a href="#">Письменные принадлежности</a>
                        </li>
                        <li>
                            <a href="#">Офисные принадлежности</a>
                        </li>
                        <li>
                            <a href="#">Принадлежности для делопроизводства</a>
                        </li>
                        <li>
                            <a href="#">Упаковочные материалы</a>
                        </li>
                        <li>
                            <a href="#">Презентационное оборудование</a>
                        </li>
                        <li>
                            <a href="#">Офисная техника</a>
                        </li>
                        <li>
                            <a href="#">Компьютерная техника</a>
                        </li>
                        <li>
                            <a href="#">Бытовая техника</a>
                        </li>
                        <li>
                            <a href="#">Хозяйственные товары</a>
                        </li>
                        <li>
                            <a href="#">Продовольственные товары</a>
                        </li>
                        <li>
                            <a href="#">Мебель для офиса</a>
                        </li>
                        <li>
                            <a href="#">Деловые подарки</a>
                        </li>
                        <li>
                            <a href="#">Школа и развитие детей NEW</a>
                        </li>
                        <li>
                            <a href="#">Средства защиты</a>
                        </li>
                        <li>
                            <a href="#">Рекламные сувениры NEW</a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="search">
            <div class="search-icon"></div>
        </div>
        <div class="cart">
            <div class="cart-icon"></div>
        </div>
    </div>

</header>


<main role="main">
    <?= Alert::widget() ?>
    <?= $content ?>
</main>
<footer role="contentinfo">
    <div id="toTop">
        <img src="images/system/toTop.png" alt="">
        <p>наверх</p>
    </div>
    <div class="footer_wrp">
        <div class="container">
            <div class="row">
                <div class="col-md-2">

                    <ul>
                        <li><a href="#">Время работы Сall-центра</a></li>
                        <li><a href="#"><b>Сервисы</b></a></li>
                        <li><a href="#">Словарь терминов</a></li>
                        <li><a href="#">Карта сайта</a></li>
                    </ul>
                </div>
                <div class="col-md-2">



                    <ul>
                        <li><a href="#"><b>Пользователям</b></a></li>
                        <li><a href="#">Оплата и доставка</a></li>
                        <li><a href="#">Обратная связь</a></li>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul>
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Контакты</a></li>
                        <li><a href="#">Список наших ТМ</a></li>
                        <li><a href="#">Важные объявления</a></li>
                        <li><a href="#">новости сети</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li><b>Звоните по номеру:</b></li>
                        <li><a href="tel:(044) 503-71-79">(044) 503-71-79</a></li>
                        <li><a href="tel:(044) 503-71-79">(044) 503-71-79</a></li>
                        <li><a href="tel:(044) 503-71-79">(044) 503-71-79</a></li>
                    </ul>
                </div>
                <div id="fb-root"></div>
                <script type="text/javascript">
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.10";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="col-md-4">
                    <div class="pull-left" style="margin-right: 25px;">

                        <img src="images/system/visa.png" alt="">

                    </div>

                    <p>
                        Присоединяйтесь

                    </p>
                    <div class="fb-page"
                         data-href="https://www.facebook.com/uapapirus/"
                         data-width="380"
                         data-hide-cover="false"
                         data-show-facepile="false"></div>
                </div>

            </div>
        </div>
    </div>
</footer>
<!--light-box styles-->
<!--<link rel="stylesheet" href="https://mreq.github.io/slick-lightbox/gh-pages/bower_components/slick-carousel/slick/slick-theme.css">-->
<!--light-box styles-->
<!-- ADD SCRIPTS -->
<!-- JQuery -->
<!--<script src="libs/jquery/dist/jquery.min.js"></script>-->

<!-- Slick-carousel -->
<!-- <script src="libs/slick-carousel/slick/slick.min.js"></script> -->
<!-- Map Script -->
<!--<script src="libs/jquery-validation/dist/jquery.validate.min.js"></script>-->
<!--<script src="libs/jquery-ui/jquery-ui.min.js"></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
<!--<script src="libs/swiper/js/swiper.min.js"></script>-->
<!--<script src="libs/selectric/jquery.selectric.min.js"></script>-->
<!--<script src="libs/jquery.mmenu/jquery.mmenu.all.js"></script>-->

<!--<script src="libs/jQueryFormStyler/dist/jquery.formstyler.js"></script>-->

<!--<script src="libs/star/jquery.raty.min.js"></script>-->
<!--<script src="libs/countdown/jquery.countdown.min.js"></script>-->

<!--<script src="libs/slick-carousel/slick/slick.min.js"></script>-->
<!--<script src="libs/slick_light/slick_lightbox.js"></script>-->

<!--<script src="libs/lightbox2/js/lightbox.js"></script>-->
<!-- Bootstrap -->
<!--<script src="libs/bootstrap/js/bootstrap.min.js"></script>-->
<!-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBMIdjyZmJPMrW7Kq2S9u-xmMIJnrIRMIg&amp;amp;amp;sensor=false"></script> -->
<!-- Common Script -->
<script>
    $('#serach-input').click(function () {
        $(this).toggleClass('act')
        $('.top-serch-block--result').toggleClass('act')
    })
</script>
<script src="js/common.js"></script>

<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>