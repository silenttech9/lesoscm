<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'malaysia' => [
            'class' => 'frontend\modules\malaysia\Malaysia',
        ],
        'thailand' => [
            'class' => 'frontend\modules\thailand\Thailand',
        ],
        'bangladesh' => [
            'class' => 'frontend\modules\bangladesh\Bangladesh',
        ],
        
        'gridview' => ['class' => 'kartik\grid\Module'],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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

        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],

            ],
        ],


        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
   
                /* 'malaysia/user/reminder' => 'user/reminder',
                 'malaysia/user/inbox' => 'user/inbox',
                 'malaysia/user/list' => 'user/list',
                 'malaysia/site/logout' => 'site/logout',
                 'thailand/user/reminder' => 'user/reminder',
                 'thailand/user/inbox' => 'user/inbox',
                 'thailand/user/list' => 'user/list',
                 'thailand/site/logout' => 'site/logout',*/

            ],
        ],

    ],
    'params' => $params,
];
