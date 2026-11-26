<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [ 'api' => [ 'class' => 'backend\modules\api\ModuleAPI', ], ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => \common\models\User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // Gestão de URLs "bonitas"
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/animais',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET count' => 'count',                         // Contagem total de animais
                        'GET nomes' => 'nomes',                         // Lista de nomes
                        'GET especie/{nomeanimal}' => 'especiepornome', // Lista de espécies por nome
                        'GET especie' => 'especie',                     //Lista de especies
                        'GET idade' => 'idade',                         // Lista de idades
                        'GET idade/{nomeanimal}' => 'idadepornome',     // Idade por nome
                        'GET cor' => 'cor',
                        'POST vazio' => 'postanimalvazio',              // Adicionar animais (api/animais)
                        'DELETE {nomeanimal}' => 'delpornome',          // Apagar por nome
                        'PUT {nomeanimal}' => 'putidadepornome',        // Atualizar idade por nome
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{nomeanimal}' => '<nomeanimal:\\w+>',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/adocao',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'PUT {id}/aprovado' => 'aprovado',          //Lista para a adocao ficar aprovado (ex: adocao/1/aprovado)
                        'PUT {id}/pendente' => 'pendente',          //Lista para a adocao ficar pendente
                        'PUT {id}/rejeitado' => 'rejeitado',        //Lista para a adocao ficar rejeitado
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/especie',
                    'extraPatterns' => [
                       ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>'
                    ],
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/raca',
                    'extraPatterns' => [
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>'
                    ],
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/porte',
                    'extraPatterns' => [
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>'
                    ]
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/associacao',
                    'extraPatterns' => [
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>'
                    ]
                ],

                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/ficha-clinica',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET vacinacao' => 'vacinacao',                 //Lista da ficha-clinica das vacinacoes
                        'GET desparasitacao' => 'desparasitacao',       //Lista da ficha-clinica da desparasitacao
                        'GET esterilizacao' => 'esterilizacao',         //Lista de ficha-clinica da Esterilizacao
                        'GET animal/{animal_id}' => 'por-animal',       //Lista da ficha-clinica dos animais (ex: ficha-clinica/animal/1)
                        'POST ficha-clinica' => 'postfichaclinica'         //Criar ficha-clinica
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                         '{animal_id}' => '<animal_id:\\d+>'
                    ],

                ],
            ],
        ],
    ],


    'params' => $params,
];
