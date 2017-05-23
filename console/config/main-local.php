<?php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],

    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
//            'textLayout' => 'my/layout',  // custome layout
            'htmlLayout' => 'layouts/html', // disable layout
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'rwandaguide.info@gmail.com',
                'password' => 'jwcbbofqadxsggnl',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
