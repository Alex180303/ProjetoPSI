<?php

declare(strict_types=1);

/**
 * Configuração principal da aplicação FRONTEND (área pública/para utilizadores).
 *
 * Responsável por:
 * - carregar parâmetros agregados;
 * - configurar autenticação de utilizadores e sessão/cookies do frontend;
 * - integrar RBAC com papéis por omissão para visitantes (não autenticados);
 * - definir logging, tratamento de erros e gestão de URLs.
 */
// Agrega parâmetros comuns e específicos (incluindo overrides locais) para esta aplicação.
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    // Identificador único da aplicação frontend.
    'id' => 'app-frontend',
    // Diretório base do frontend.
    'basePath' => dirname(__DIR__),
    // Inicializa o componente de log no arranque.
    'bootstrap' => ['log'],
    // Namespace onde estão os controllers do frontend.
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        // Gestão de assets (CSS/JS); acrescenta timestamp para ajudar a evitar cache stale.
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        // Configuração do request, incluindo nome específico do token CSRF do frontend.
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        // Componente de utilizador (login/logout, identidade, sessão).
        'user' => [
            'identityClass' => \common\models\User::class,
            'enableAutoLogin' => true,
            // Cookie de identidade específico do frontend.
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        // Sessão do frontend (nome distinto para separar da sessão do backend).
        'session' => [
            // Nome do cookie de sessão usado para autenticação no frontend.
            'name' => 'advanced-frontend',
        ],
        // Configuração de logging de erros/avisos.
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // Página/ação usada para apresentar erros HTTP/aplicacionais.
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        // URL manager para URLs amigáveis (regras podem ser adicionadas conforme necessário).
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],

    ],
    // Parâmetros acessíveis globalmente na aplicação frontend.
    'params' => $params,
];
