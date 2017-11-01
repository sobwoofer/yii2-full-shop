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
        'css/style.css',
    ];
    public $js = [
        'js/common.js',
        //TODO need move someone libraries into packagist.org and require from composer
        'libs/selectric/jquery.selectric.min.js',
        'libs/lodash/2.4.1/lodash.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\jquery\formstyler\FormStylerAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
