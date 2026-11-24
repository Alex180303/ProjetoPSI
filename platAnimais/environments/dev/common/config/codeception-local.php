<?php

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    require __DIR__ . '/test-local.php',
    [
        'components' => [
            'request' => [
                // !!! insira uma chave secreta no seguinte (se estiver vazia) - isto e necessario para a validacao de cookies
                'cookieValidationKey' => '',
            ],
        ],
    ]
);
