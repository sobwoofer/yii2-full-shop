<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/media.css',
        'libs/selectric/selectric.css',
        'libs/magic360/magic360.css',
        'css/style.css',
    ];
    public $js = [
        'js/common.js',
        //TODO need move someone libraries into packagist.org and require from composer
        'libs/selectric/jquery.selectric.min.js',
        'libs/lodash/2.4.1/lodash.min.js',
        'libs/lightbox/js/lightbox.js', //popup product
        'libs/slick_light/slick_lightbox.js', //popup product
        'libs/magic360/magic360.js' //popup product
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\jquery\formstyler\FormStylerAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'russ666\widgets\CountdownAsset',
        'ezoterik\html5shivAsset\Html5ShivAsset',
        'ezoterik\respondAsset\RespondAsset',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
