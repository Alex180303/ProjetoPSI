<?php

declare(strict_types=1);

namespace console\controllers;

use common\models\User;
use common\rbac\Rbac;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Gestão de papéis a partir da linha de comandos.
 *
 *   yii rbac/assign <username> <papel>   atribui um papel
 *   yii rbac/revoke <username> <papel>   retira um papel
 *   yii rbac/roles  <username>           lista os papéis do utilizador
 */
class RbacController extends Controller
{
    private const PAPEIS = [Rbac::ROLE_ADOTANTE, Rbac::ROLE_ANUNCIANTE, Rbac::ROLE_ADMIN];

    public function actionAssign(string $username, string $papel): int
    {
        $user = $this->utilizador($username);
        $role = $this->papel($papel);
        if ($user === null || $role === null) {
            return ExitCode::DATAERR;
        }

        $auth = Yii::$app->authManager;
        if ($auth->getAssignment($papel, $user->id) !== null) {
            $this->stdout("'{$username}' já tem o papel '{$papel}'.\n");
            return ExitCode::OK;
        }

        $auth->assign($role, $user->id);
        $this->stdout("Papel '{$papel}' atribuído a '{$username}'.\n");

        return ExitCode::OK;
    }

    public function actionRevoke(string $username, string $papel): int
    {
        $user = $this->utilizador($username);
        $role = $this->papel($papel);
        if ($user === null || $role === null) {
            return ExitCode::DATAERR;
        }

        Yii::$app->authManager->revoke($role, $user->id);
        $this->stdout("Papel '{$papel}' retirado a '{$username}'.\n");

        return ExitCode::OK;
    }

    public function actionRoles(string $username): int
    {
        $user = $this->utilizador($username);
        if ($user === null) {
            return ExitCode::DATAERR;
        }

        $papeis = array_keys(Yii::$app->authManager->getRolesByUser($user->id));
        $this->stdout("'{$username}': " . ($papeis ? implode(', ', $papeis) : '(sem papéis)') . "\n");

        return ExitCode::OK;
    }

    private function utilizador(string $username): User|null
    {
        $user = User::findOne(['username' => $username]);
        if ($user === null) {
            $this->stderr("Utilizador '{$username}' não encontrado.\n");
        }

        return $user;
    }

    private function papel(string $nome): \yii\rbac\Role|null
    {
        if (!in_array($nome, self::PAPEIS, true)) {
            $this->stderr("Papel inválido. Use: " . implode(', ', self::PAPEIS) . "\n");
            return null;
        }

        return Yii::$app->authManager->getRole($nome);
    }
}
