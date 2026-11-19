<?php

declare(strict_types=1);

/**
 * Configuração principal da aplicação CONSOLE (CLI).
 *
 * Usada para executar comandos no terminal (migrações, RBAC, fixtures, tarefas de manutenção).
 * É especialmente relevante para:
 * - ligação à BD via componentes comuns (herdados/mesclados conforme ambiente);
 * - migrações do Yii2, incluindo as migrações do RBAC;
 * - comandos customizados em `console\controllers` (ex.: RbacController).
 */
// Agrega parâmetros de configuração partilhados e locais.
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    // Identificador da aplicação de consola.
    'id' => 'app-console',
    // Diretório base da app console.
    'basePath' => dirname(__DIR__),
    // Inicializa logging no arranque dos comandos.
    'bootstrap' => ['log'],
    // Namespace padrão dos controladores de consola.
    'controllerNamespace' => 'console\controllers',
    // Aliases úteis (assets/dependências front-end, caso necessário em tarefas).
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // Mapeamento de controladores de consola e respetivas opções.
    'controllerMap' => [
        // Comando de migrações: inclui migrações da aplicação e do módulo RBAC do Yii.
        // Isto cria/atualiza tabelas de negócio e tabelas auth_* usadas pelo DbManager.
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => ['@app/migrations', '@yii/rbac/migrations'],
        ],
        // Comando para carregar fixtures (dados de teste) definidas em common\fixtures.
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        // Logging de erros/avisos durante a execução de comandos.
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    // Parâmetros disponíveis para comandos de consola.
    'params' => $params,
];
