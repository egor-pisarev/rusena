<?php

$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
    'id' => 'app',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'name'=>'Русена',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BBsh8QppgHjPeG8elJZUfH7ichK8PUK9',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [YII_DEBUG ? 'jquery.js' : 'jquery.min.js'],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
                ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'rules' => [
                'page/<slug>' => 'site/page',
                'admin/user'=>'user/admin',
                'news/<slug>'=>'site/news',
                'news'=>'site/news',
                'catalog/<slug>'=>'shop/catalog/list',
                'catalog'=>'shop/catalog/index',
                'catalog/<category>/<slug>'=>'shop/catalog/view',
                'cart'=>'shop/cart/list',
                'admin/shop/<controller>/<action>'=>'shop/admin/<controller>/<action>',
                'search'=>'site/search',
                'search/<ProductSearch[text]>'=>'site/search',
            ],
        ],
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'class' => 'yii\base\Theme',
                'pathMap' => [
                    '@app/views' => '@app/themes/rusena',
                    '@vendor/dektrium/yii2-user/widgets/views'=>'@app/themes/rusena/views/widgets',
                    '@vendor/dektrium/yii2-user/views'=>'@app/themes/rusena/modules/user/views',
                    '@easyii/views/layouts'=>'@app/themes/rusena/layouts/admin',
                ],
                'baseUrl'   => 'themes/rusena'
            ]
        ],
        'cart' => [
            'class' => 'app\modules\shop\components\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
        'i18n' => [
            'translations' => [
                'news' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/modules/news/messages',
                    'fileMap' => [
                        'news' => 'admin.php',
                        'easyii/news' => 'admin.php',
                    ]
                ]
            ],
        ],
        'formatter' => [
            'dateFormat' => 'd.m.Y',
            'timeFormat' => 'H:i:s',
            'datetimeFormat' => 'd.m.Y H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\UserModule',
            'enableConfirmation'=>false,
            'modelMap' => [
                'User' => 'app\modules\user\models\User',
            ],
            'admins'=>['admin'],
        ],
        'shop'=>[
            'class'=>'app\modules\shop\Module',
        ]

    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    
    $config['components']['db']['enableSchemaCache'] = false;
}

return array_merge_recursive($config, require(dirname(__FILE__) . '/../../vendor/noumo/easyii/config/easyii.php'));