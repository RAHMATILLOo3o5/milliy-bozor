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
            'siteKeyV2' => '6Le6-qIgAAAAACOeRN6QfQI83kyn0e8hyfz_Ser9',
            'secretV2' => '6Le6-qIgAAAAANFZM-kAkEtVe7G49Av1bFntmBJb',
            'siteKeyV3' => '6LdK-qIgAAAAAKL2_92Q1o2LQyHbHPf5Tv9EyPOf',
            'secretV3' => '6LdK-qIgAAAAAGup4DlxMvB8ofWcEq3FEbAL6aLL',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'ssl',
                'host' => 'smtp.titan.email',
                'port' => '465',
                'username' => 'bozor@milliy-bozor.com',
                'password' => 'MilliyBozor',
            ],
        ],
    ],
];
