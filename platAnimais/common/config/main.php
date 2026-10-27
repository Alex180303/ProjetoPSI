<?php

declare(strict_types=1);

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
            'class' => 'yii\rbac\DBManager',
            'cache' => [
                'class' => \yii\caching\FileCache::class,
            ],
        ],
<<<<<<< Updated upstream
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
=======


>>>>>>> Stashed changes
    ],
];
