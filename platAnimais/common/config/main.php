<?php

declare(strict_types=1);

use yii\rbac\DbManager;

/**
 * Configuração comum (base) partilhada por backend, frontend e console.
 *
 * Aqui definem-se componentes e definições globais da aplicação Yii2, como:
 * - bootstrap de classes utilitárias;
 * - aliases de caminhos (ex.: assets bower/npm);
 * - caminho do diretório vendor;
 * - `authManager` para RBAC (controlo de acesso baseado em papéis/permissões).
 */
return [
    'bootstrap' => [
        \common\bootstrap\MailerBootstrap::class,
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // Caminho absoluto para as dependências instaladas pelo Composer.
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // Gestor de RBAC baseado em base de dados (tabelas auth_*).
        // Guarda itens (roles/permissions), regras e atribuições de papéis a utilizadores.
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
                   ],
    ],
];
