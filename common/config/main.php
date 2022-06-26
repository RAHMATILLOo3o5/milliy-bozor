<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],

    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6Le_XUsgAAAAAA7D2o_2sXVY_u3iJ5HUXUGTymrJ',
            'secretV2' => '6Le_XUsgAAAAACA85qaRfREOiHZTHeAOdzGOD3jG',
            'siteKeyV3' => '6LckYy0gAAAAAFM1eJDq6JcC4QwLhqSrOUxlbuui',
            'secretV3' => '6LckYy0gAAAAAKWgAlSI4N5OCpM_hVkX3Zr4EGpY',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'ssl',
                'host' => 'smtp.mail.ru',
                'port' => '465',
                'username' => 'husanboyev05@mail.ru',
                'password' => 'gNpf8tVXchQ7meZpEh6L',
            ],
        ],
    ],
];
