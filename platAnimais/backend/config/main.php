<?php

/**
 * Configuração principal da aplicação BACKEND (área administrativa/backoffice).
 *
 * Responsável por:
 * - carregar parâmetros (common + locais + backend);
 * - definir identidade da aplicação, namespace de controllers e módulos (ex.: módulo API);
 * - configurar componentes centrais: request/CSRF, utilizador/sessão, logging, erros e URL manager;
 * - expor regras de URLs REST para o módulo de API.
 */
// Agrega parâmetros de vários níveis para permitir overrides por ambiente/app.
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    // Identificador único da aplicação.
    'id' => 'app-backend',
    // Diretório base do backend.
    'basePath' => dirname(__DIR__),
    // Namespace padrão onde o Yii procura controllers web do backend.
    'controllerNamespace' => 'backend\controllers',
    // Componentes inicializados no arranque (ex.: logging).
    'bootstrap' => ['log'],
    // Módulos da aplicação; aqui é registado o módulo de API REST.
    'modules' => [ 'api' => [ 'class' => 'backend\modules\api\ModuleAPI', ], ],
    'components' => [
        // Configuração do pedido HTTP (nome do parâmetro CSRF específico do backend).
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        // Componente de autenticação/sessão de utilizador no backend.
        'user' => [
            // Classe do modelo de identidade (implementa IdentityInterface).
            'identityClass' => \common\models\User::class,
            // Permite login persistente via cookie ("remember me").
            'enableAutoLogin' => true,
            // Cookie de identidade separado do frontend para evitar colisões de sessão.
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        // Sessão PHP usada no backend (nome distinto do frontend).
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        // Registo de logs da aplicação.
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    // Guarda erros e avisos em ficheiros (runtime/logs).
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // Tratamento de erros: delega a renderização para a ação site/error.
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // Gestão de URLs "bonitas" e mapeamento de rotas REST da API.
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                [
                    // Regra REST para o controller api/animais, incluindo ações extra personalizadas.
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/animais',
                    'extraPatterns' => [
                        'GET count' => 'count',                       // Contagem total de animais
                        'GET nomes' => 'nomes',                       // Lista de nomes
                        'GET especie' => 'especie',                   // Lista de espécies
                        'GET idade' => 'idade',                       // Lista de idades
                        'GET idade/{nomeanimal}' => 'idadepornome',  // Idade(s) por nome
                        'DELETE {nomeanimal}' => 'delpornome',        // Apagar por nome
                        'PUT {nomeanimal}' => 'putidadepornome',      // Atualizar idade por nome
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{nomeanimal}' => '<nomeanimal:\\w+>',
                    ],
                ],
            ],
        ],

    ],
    // Parâmetros finais disponíveis em Yii::$app->params.
    'params' => $params,
];
