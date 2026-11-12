<?php

declare(strict_types=1);

namespace common\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Regra que só autoriza pedidos NÃO autenticados.
 *
 * Associada ao papel "visitante" (que é um papel por omissão), garante que
 * as permissões do visitante, como "registarConta", só se aplicam a quem
 * ainda não iniciou sessão.
 */
class GuestRule extends Rule
{
    public $name = 'isGuest';

    public function execute($user, $item, $params): bool
    {
        return Yii::$app->has('user') && Yii::$app->user->isGuest;
    }
}
