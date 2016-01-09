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
        'user' => [
            'admins' => ['admin'],
        ],
    ],
    'components' => [
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
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
    ],
    'params' => $params,
];
