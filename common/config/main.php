<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'user' => [
            'class' => 'budyaga\users\Module',
            'userPhotoUrl' => '/images/user/photo',
            'userPhotoPath' => dirname(dirname(__DIR__)) . '/frontend/web/images/user/photo'
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ],
    ],    
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'budyaga\users\components\oauth\VKontakte',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                    'scope' => 'email'
                ],
                'google' => [
                    'class' => 'budyaga\users\components\oauth\Google',
                    'clientId' => '865560032033-ggttatkvs564bcvoab2j8m8k9db6l4pv.apps.googleusercontent.com',
                    'clientSecret' => 'xdi2B3TBcOuRCFv0AjLLCNcw',
                ],
                'facebook' => [
                    'class' => 'budyaga\users\components\oauth\Facebook',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'github' => [
                    'class' => 'budyaga\users\components\oauth\GitHub',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                    'scope' => 'user:email, user'
                ],
                'linkedin' => [
                    'class' => 'budyaga\users\components\oauth\LinkedIn',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'live' => [
                    'class' => 'budyaga\users\components\oauth\Live',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'yandex' => [
                    'class' => 'budyaga\users\components\oauth\Yandex',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                'twitter' => [
                    'class' => 'budyaga\users\components\oauth\Twitter',
                    'consumerKey' => 'XXX',
                    'consumerSecret' => 'XXX',
                ],
            ],
        ],        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
