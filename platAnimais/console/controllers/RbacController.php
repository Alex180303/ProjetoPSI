<?php

declare(strict_types=1);

namespace console\controllers;

use common\models\User;
use common\rbac\Rbac;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Controlador de consola para gestão de papéis RBAC.
 *
 * Permite administrar atribuições de papéis a utilizadores via terminal (útil em setup,
 * manutenção ou ambientes sem interface de gestão de utilizadores).
 *
 * Exemplos de uso:
 *   php yii rbac/assign <username> <papel>   -> atribui um papel ao utilizador
 *   php yii rbac/revoke <username> <papel>   -> remove um papel do utilizador
 *   php yii rbac/roles  <username>           -> lista os papéis atribuídos ao utilizador
 *
 * Depende do componente `authManager` configurado na aplicação (ex.: DbManager) e dos papéis
 * previamente criados na base de dados pela migração de RBAC.
 */
class RbacController extends Controller
{
    /**
     * Lista de papéis que este comando permite atribuir/remover via consola.
     * (O papel "visitante" é normalmente um papel por omissão aplicado por regra, não atribuído.)
     */
    private const PAPEIS = [Rbac::ROLE_ADOTANTE, Rbac::ROLE_ANUNCIANTE, Rbac::ROLE_ADMIN];

    /**
     * Atribui um papel a um utilizador, se ainda não estiver atribuído.
     *
     * @param string $username Nome de utilizador (campo username em common\models\User).
     * @param string $papel    Identificador do papel (deve existir em authManager e em self::PAPEIS).
     * @return int Código de saída da consola (0 = OK, erro de dados caso contrário).
     */
    public function actionAssign(string $username, string $papel): int
    {
        // Valida existência do utilizador e do papel antes de alterar atribuições.
        $user = $this->utilizador($username);
        $role = $this->papel($papel);
        if ($user === null || $role === null) {
            return ExitCode::DATAERR;
        }

        $auth = Yii::$app->authManager;

        // Evita duplicar atribuições (getAssignment verifica se o par utilizador/papel já existe).
        if ($auth->getAssignment($papel, $user->id) !== null) {
            $this->stdout("'{$username}' já tem o papel '{$papel}'.\n");
            return ExitCode::OK;
        }

        // Persiste a atribuição do papel ao utilizador (tabela auth_assignment).
        $auth->assign($role, $user->id);
        $this->stdout("Papel '{$papel}' atribuído a '{$username}'.\n");

        return ExitCode::OK;
    }

    /**
     * Remove (revoga) um papel de um utilizador.
     *
     * @param string $username Nome de utilizador.
     * @param string $papel    Identificador do papel a remover.
     * @return int Código de saída da consola.
     */
    public function actionRevoke(string $username, string $papel): int
    {
        $user = $this->utilizador($username);
        $role = $this->papel($papel);
        if ($user === null || $role === null) {
            return ExitCode::DATAERR;
        }

        // Revoga a atribuição no authManager (não apaga o utilizador nem o papel).
        Yii::$app->authManager->revoke($role, $user->id);
        $this->stdout("Papel '{$papel}' retirado a '{$username}'.\n");

        return ExitCode::OK;
    }

    /**
     * Lista todos os papéis atualmente atribuídos a um utilizador.
     *
     * @param string $username Nome de utilizador.
     * @return int Código de saída da consola.
     */
    public function actionRoles(string $username): int
    {
        $user = $this->utilizador($username);
        if ($user === null) {
            return ExitCode::DATAERR;
        }

        // Obtém os papéis efetivos do utilizador a partir do authManager.
        $papeis = array_keys(Yii::$app->authManager->getRolesByUser($user->id));
        $this->stdout("'{$username}': " . ($papeis ? implode(', ', $papeis) : '(sem papéis)') . "\n");

        return ExitCode::OK;
    }

    /**
     * Procura um utilizador pelo username e reporta erro se não existir.
     */
    private function utilizador(string $username): User|null
    {
        $user = User::findOne(['username' => $username]);
        if ($user === null) {
            $this->stderr("Utilizador '{$username}' não encontrado.\n");
        }

        return $user;
    }

    /**
     * Valida se o nome do papel é permitido e se existe no authManager.
     */
    private function papel(string $nome): \yii\rbac\Role|null
    {
        // Restringe aos papéis conhecidos para evitar operações acidentais com nomes inválidos.
        if (!in_array($nome, self::PAPEIS, true)) {
            $this->stderr("Papel inválido. Use: " . implode(', ', self::PAPEIS) . "\n");
            return null;
        }

        return Yii::$app->authManager->getRole($nome);
    }
}
