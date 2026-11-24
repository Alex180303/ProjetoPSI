<?php

$config = [
    'components' => [
        'request' => [
            // !!! insira uma chave secreta no seguinte (se estiver vazia) - isto e necessario para a validacao de cookies
            'cookieValidationKey' => '',
        ],
    ],
];

if (YII_ENV_DEV) {
    // ajustes de configuracao para o ambiente 'dev'
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
    ];
}

return $config;
