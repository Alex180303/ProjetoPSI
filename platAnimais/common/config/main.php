<?php

declare(strict_types=1);

use common\rbac\Rbac;
use yii\rbac\DbManager;

return [
    'bootstrap' => [
        \common\bootstrap\MailerBootstrap::class,
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => DbManager::class,
            // O papel "visitante" não é atribuído explicitamente: aplica-se a
            // qualquer pedido não autenticado através da regra isGuest.
            'defaultRoles' => [Rbac::ROLE_VISITANTE],
            // 'cache' => 'cache',
        ],
    ],
];
