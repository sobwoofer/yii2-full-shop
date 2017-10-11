<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@staticRoot' => $params['staticPath'],
        '@static'   => $params['staticHostInfo'],
    ],
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
        [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => 'json',
                'application/xml' => 'xml',
            ],
        ],
    ],
    'modules' => [
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'common\auth\Identity',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ]
        ]
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\auth\Identity',
            'enableAutoLogin' => false,
            'enableSession' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',
                //for domain.com/v1/.. version api
                'v1/profile' => 'user/profile/index',
                'GET v1/shop/products/<id:\d+>' => 'v1/shop/product/view',
                'GET v1/shop/products/category/<id:\d+>' => 'v1/shop/product/category',
                'GET v1/shop/products/brand/<id:\d+>' => 'v1/shop/product/brand',
                'GET v1/shop/products/tag/<id:\d+>' => 'v1/shop/product/tag',
                'GET v1/shop/products' => 'v1/shop/product/index',
                'v1/shop/products/<id:\d+>/cart' => 'v1/shop/cart/add',
                'v1/shop/products/<id:\d+>/wish' => 'v1/shop/wishlist/add',
                'v1/shop/cart/checkout' => 'v1/shop/checkout/index',

                'GET v1/shop/cart' => 'v1/shop/cart/index',
                'DELETE v1/shop/cart' => 'v1/shop/cart/clear',
                'PUT v1/shop/cart/<id:\w+>/quantity' => 'v1/shop/cart/quantity',
                'DELETE v1/shop/cart/<id:\w+>' => 'v1/shop/cart/delete',

                'GET shop/wishlist' => 'v1/shop/wishlist/index',
                'DELETE shop/wishlist/<id:\d+>' => 'v1/shop/wishlist/delete',

            ],
        ],
    ],
    'as authenticator' => [
        'class' => 'filsh\yii2\oauth2server\filters\auth\CompositeAuth',
        'except' => ['site/index', 'oauth2/rest/token'],
        'authMethods' => [
            ['class' => 'yii\filters\auth\HttpBearerAuth'],
            ['class' => 'yii\filters\auth\QueryParamAuth', 'tokenParam' => 'accessToken'],
        ]
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['site/index', 'oauth2/rest/token'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'as exceptionFilter' => [
        'class' => 'filsh\yii2\oauth2server\filters\ErrorToExceptionFilter',
    ],
    'params' => $params,
];
