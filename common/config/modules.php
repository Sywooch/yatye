<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 11:47 AM
 */

return [
    'user' => [
        'class' => 'dektrium\user\Module',
        'mailer' => [
            'sender' => ['rwandaguide@rwandaguide.info' => 'Rwanda Guide'],
            'welcomeSubject' => 'Welcome to Rwanda Guide',
            'confirmationSubject' => 'Rwanda Guide Account Confirmation',
            'reconfirmationSubject' => 'Rwanda Guide Email Change Confirmation',
            'recoverySubject' => 'Rwanda Guide Password Recovery',
        ],
        'admins' => ['Marius'],
        'enableUnconfirmedLogin' => false,
        'enableGeneratingPassword' => true,
        'enableConfirmation' => true,
        'enablePasswordRecovery' => true,
        'modelMap' => [
            'User' => 'common\models\User',
            'LoginForm' => 'common\models\LoginForm',
            'RecoveryForm' => 'common\models\RecoveryForm',
        ],
    ],

    'rbac' => [
        'class' => 'dektrium\rbac\RbacWebModule',
    ],

    'gridview' => [
        'class' => '\kartik\grid\Module'
    ],
];