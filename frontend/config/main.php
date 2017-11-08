<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'sourceLanguage'=>'ru',
    'language'=>'ru',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
        'languagesDispatcher',
        'frontend\bootstrap\SetUp',
    ],
    'aliases' => [
        '@staticRoot' => $params['staticPath'],
        '@static'   => $params['staticHostInfo'],
    ],
    'layout' => 'blank',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        // dispatcher for get to apps query where id language from url
        'languagesDispatcher' => [
            'class' => 'cetver\LanguagesDispatcher\Component',
            'languages' => ['ua'],
            'handlers' => [
                [
                    // Detects a language from the query parameter.
                    'class' => 'cetver\LanguagesDispatcher\handlers\QueryParamHandler',
                ],

            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'common\auth\Identity',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
            'loginUrl' => ['auth/auth/login'],
        ],
        'session' => [
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'frontendUrlManager' => require __DIR__ . '/urlManager.php',
        'backendUrlManager' => require __DIR__ . '/../../backend/config/urlManager.php',
        'urlManager' => function(){
            return Yii::$app->get('frontendUrlManager');
        },
    ],
    'params' => $params,
];
