<?php

declare(strict_types=1);

namespace common\rbac;

use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Regra que aplica o papel "visitante" apenas a utilizadores não autenticados.
 *
 * O papel é configurado em authManager.defaultRoles, pelo que não precisa de
 * ser atribuído explicitamente a cada visitante.
 */
class GuestRule extends Rule
{
    public $name = 'isGuest';

    /**
     * @param string|int|null $user ID do utilizador (null quando é visitante).
     * @param Item $item Papel ou permissão em verificação.
     * @param array $params Parâmetros passados a User::can().
     * @return bool
     */
    public function execute($user, $item, $params): bool
    {
        return $user === null || $user === '';
    }
}
