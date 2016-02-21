<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'modules' => [
//        'user' => [
//            'admins' => ['admin'],
//        ],
    ],
    'components' => [
        'user' => [
            //'identityClass' => 'common\models\User',
            //'enableAutoLogin' => true,
            'identityClass' => 'budyaga\users\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],            
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                // budyaga/yii2-users rules
                //--------------------------------------------------------------
                '/signup' => '/user/user/signup',
                '/login' => '/user/user/login',
                '/logout' => '/user/user/logout',
                '/requestPasswordReset' => '/user/user/request-password-reset',
                '/resetPassword' => '/user/user/reset-password',
                '/profile' => '/user/user/profile',
                '/retryConfirmEmail' => '/user/user/retry-confirm-email',
                '/confirmEmail' => '/user/user/confirm-email',
                '/unbind/<id:[\w\-]+>' => '/user/auth/unbind',
                '/oauth/<authclient:[\w\-]+>' => '/user/auth/index',
                //--------------------------------------------------------------
                /*'<_a:error>' => 'site/<_a>',
 
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',*/
            ],
        ],        
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'booleanFormat' => ['Нет','Да'],
            'dateFormat' => 'php:d.m.Y',         //Тут можно формат вывода дат по умолчанию настроить
            'datetimeFormat' => 'php:d.m.Y H:i:s',
            'timeFormat' => 'short',         
            'nullDisplay' => 'Не задано',
            'defaultTimeZone' => 'Asia/Baku',
        ],
        'view' => [
            'theme' => 'vova07\themes\admin\Theme'
        ],
    ],
    'params' => $params,
];
