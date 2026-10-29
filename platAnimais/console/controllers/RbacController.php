<?php

declare(strict_types=1);

namespace console\controllers;

use common\models\User;
use common\rbac\Rbac;
use common\rbac\RbacInitializer;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\rbac\ManagerInterface;

/**
 * Gestão da árvore RBAC da plataforma de adoção.
 *
 * Segue o padrão recomendado pelo guia do Yii (Security > Authorization):
 * os papéis e permissões são definidos no código e aplicados por um comando
 * de consola; as atribuições a utilizadores são feitas individualmente.
 */
class RbacController extends Controller
{
    /**
     * Cria/atualiza papéis, permissões, regras e hierarquia.
     *
     * As atribuições já existentes são preservadas.
     */
    public function actionInit(): int
    {
        RbacInitializer::build($this->authManager());

        $this->stdout("Árvore RBAC criada/atualizada com sucesso.\n", \yii\helpers\Console::FG_GREEN);
        $this->stdout('Papéis: ' . implode(', ', array_keys(Rbac::roles())) . "\n");
        $this->stdout('Permissões: ' . count(Rbac::permissions()) . "\n");
        $this->stdout("Para reconstruir de raiz (apaga atribuições) use: yii rbac/reset\n");

        return ExitCode::OK;
    }

    /**
     * Apaga toda a árvore RBAC e reconstrói a matriz a partir do código.
     *
     * ATENÇÃO: remove também todas as atribuições de papéis a utilizadores.
     */
    public function actionReset(): int
    {
        if (!$this->confirm('Isto remove todos os papéis atribuídos aos utilizadores. Continuar?')) {
            $this->stdout("Operação cancelada.\n");
            return ExitCode::OK;
        }

        RbacInitializer::reset($this->authManager());

        $this->stdout("Árvore RBAC reconstruída com sucesso.\n", \yii\helpers\Console::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Atribui um papel a um utilizador existente.
     *
     * Uso: yii rbac/assign <username> <role>
     */
    public function actionAssign(string $username, string $role): int
    {
        $auth = $this->authManager();

        $user = User::findOne(['username' => $username]);
        if ($user === null) {
            $this->stderr("Utilizador não encontrado: {$username}\n", \yii\helpers\Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $authRole = $auth->getRole($role);
        if ($authRole === null) {
            $this->stderr("Papel inválido: {$role}\n", \yii\helpers\Console::FG_RED);
            $this->stdout('Papéis disponíveis: ' . implode(', ', array_keys(Rbac::roles())) . "\n");
            return ExitCode::UNSPECIFIED_ERROR;
        }

        if ($auth->getAssignment($role, $user->getId()) !== null) {
            $this->stdout("O utilizador {$username} já tem o papel {$role}.\n");
            return ExitCode::OK;
        }

        $auth->assign($authRole, $user->getId());

        $this->stdout("Papel {$role} atribuído a {$username}.\n", \yii\helpers\Console::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Remove um papel a um utilizador.
     *
     * Uso: yii rbac/revoke <username> <role>
     */
    public function actionRevoke(string $username, string $role): int
    {
        $auth = $this->authManager();

        $user = User::findOne(['username' => $username]);
        if ($user === null) {
            $this->stderr("Utilizador não encontrado: {$username}\n", \yii\helpers\Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        if ($auth->getAssignment($role, $user->getId()) === null) {
            $this->stdout("O utilizador {$username} não tem o papel {$role}.\n");
            return ExitCode::OK;
        }

        $authRole = $auth->getRole($role);
        if ($authRole === null) {
            $this->stderr("Papel inválido: {$role}\n", \yii\helpers\Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $auth->revoke($authRole, $user->getId());

        $this->stdout("Papel {$role} removido a {$username}.\n", \yii\helpers\Console::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Mostra a matriz carregada na base de dados e as atribuições existentes.
     */
    public function actionShow(): int
    {
        $auth = $this->authManager();

        $this->stdout("Papéis e permissões\n", \yii\helpers\Console::BOLD);
        $this->stdout(str_repeat('-', 70) . "\n");

        foreach (array_keys(Rbac::roles()) as $roleName) {
            $role = $auth->getRole($roleName);
            if ($role === null) {
                $this->stdout("{$roleName}: (não existe)\n", \yii\helpers\Console::FG_YELLOW);
                continue;
            }

            $permissions = array_map(
                static fn($child): string => $child->name,
                $auth->getPermissionsByRole($roleName),
            );
            sort($permissions);

            $this->stdout("\n{$roleName}\n", \yii\helpers\Console::FG_CYAN);
            foreach ($permissions as $permission) {
                $this->stdout("  - {$permission}\n");
            }
        }

        $this->stdout("\nAtribuições\n", \yii\helpers\Console::BOLD);
        $this->stdout(str_repeat('-', 70) . "\n");

        $rows = (new \yii\db\Query())
            ->select(['a.user_id', 'a.item_name', 'u.username'])
            ->from(['a' => '{{%auth_assignment}}'])
            ->leftJoin(['u' => '{{%user}}'], 'u.id = a.user_id')
            ->orderBy(['u.username' => SORT_ASC, 'a.item_name' => SORT_ASC])
            ->all();

        if ($rows === []) {
            $this->stdout("(sem atribuições)\n");
        }

        foreach ($rows as $row) {
            $this->stdout("{$row['username']} ({$row['user_id']}): {$row['item_name']}\n");
        }

        return ExitCode::OK;
    }

    private function authManager(): ManagerInterface
    {
        /** @var ManagerInterface $auth */
        $auth = Yii::$app->authManager;

        return $auth;
    }
}
