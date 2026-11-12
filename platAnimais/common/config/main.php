<?php

declare(strict_types=1);

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
            // Os papéis por omissão (visitante) são definidos apenas no frontend.
            // 'cache' => 'cache',
        ],
    ],
];
