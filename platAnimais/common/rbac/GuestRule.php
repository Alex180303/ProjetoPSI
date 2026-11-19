<?php

declare(strict_types=1);

namespace common\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Regra RBAC personalizada: "isGuest".
 *
 * Objetivo: autorizar apenas pedidos de utilizadores NÃO autenticados.
 *
 * Como é usada:
 * - Na migração de RBAC, esta regra é associada ao papel "visitante".
 * - No frontend, o `authManager` pode ter `defaultRoles` = [Rbac::ROLE_VISITANTE],
 *   fazendo com que utilizadores anónimos "herdem" esse papel automaticamente.
 * - A regra garante que permissões exclusivas de visitante (ex.: registarConta)
 *   não se aplicam depois do login.
 *
 * @see \yii\rbac\Rule
 */
class GuestRule extends Rule
{
    /**
     * Nome único da regra, usado ao registá-la no authManager e ao associá-la a itens RBAC.
     * Deve coincidir com o nome definido na migração.
     */
    public $name = 'isGuest';

    /**
     * Avalia se a regra é satisfeita para o utilizador/operação atual.
     *
     * @param int|string|null $user ID do utilizador (ou null em alguns contextos); não é necessário aqui.
     * @param \yii\rbac\Item $item Papel/permissão ao qual a regra está associada.
     * @param array $params Parâmetros adicionais passados na verificação (não usados).
     * @return bool true se o pedido for de um utilizador anónimo (guest), caso contrário false.
     */
    public function execute($user, $item, $params): bool
    {
        // Confirma que a aplicação tem componente "user" e que não existe sessão autenticada.
        return Yii::$app->has('user') && Yii::$app->user->isGuest;
    }
}
