<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'CED Homecoming',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Asia/Bangkok',
    'components' => [
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hCK_bSa5tHc9CIlJTAEickhBfomi3ILG',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '976365394417-s9oc7udd3467gslbj96rum5voe4n4uct.apps.googleusercontent.com',
                    'clientSecret' => 'WjDqjJPD3VcfrX4HkkYr1uWF',
                ]
            ],
        ],

        'assetManager' => [
            // override bundles to use local project files :
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap/dist',
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap/dist',
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ],
            ],
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                '@app/views' => '@vendor/themes/adminlte/yii2-app/views'
                ],
            ],
        ],


	'formatter' => [
       		'dateFormat' => 'dd.MM.yyyy',
        	'decimalSeparator' => ',',
       	 	'thousandSeparator' => ' ',
        	'currencyCode' => 'THB',
  	 ],


    ],
    'params' => $params,
];
/*
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
*/

return $config;
