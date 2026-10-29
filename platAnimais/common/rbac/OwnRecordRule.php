<?php

declare(strict_types=1);

namespace common\rbac;

use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Regra para as permissões "próprios": só permite o acesso quando o registo
 * pertence ao utilizador autenticado (ou a uma associação a que pertence).
 *
 * Exemplos de utilização:
 *
 *     Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, ['ownerId' => $animal->user_id]);
 *     Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, ['model' => $animal]);
 *     Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, ['model' => $animal, 'ownerAttribute' => 'anunciante_id']);
 *     Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, ['ownerIds' => [$user->id, $associacao->id]]);
 *
 * Este controlo complementa a verificação RBAC e deve ser sempre usado em
 * conjunto com ela: a permissão diz "pode gerir os próprios", a regra diz
 * "este registo é dele".
 */
class OwnRecordRule extends Rule
{
    public $name = 'isOwner';

    /**
     * @param string|int|null $user ID do utilizador autenticado.
     * @param Item $item Papel ou permissão em verificação.
     * @param array $params Parâmetros com ownerId, ownerIds ou model.
     * @return bool
     */
    public function execute($user, $item, $params): bool
    {
        if ($user === null || $user === '') {
            return false;
        }

        if (isset($params['ownerId']) && $this->matches($params['ownerId'], $user)) {
            return true;
        }

        if (isset($params['ownerIds'])) {
            foreach ((array) $params['ownerIds'] as $ownerId) {
                if ($this->matches($ownerId, $user)) {
                    return true;
                }
            }
        }

        if (isset($params['model'])) {
            $attribute = $params['ownerAttribute'] ?? 'user_id';
            $model = $params['model'];
            $ownerId = is_array($model)
                ? ($model[$attribute] ?? null)
                : ($model->$attribute ?? null);

            return $this->matches($ownerId, $user);
        }

        return false;
    }

    private function matches(mixed $ownerId, string|int $user): bool
    {
        return $ownerId !== null && $ownerId !== '' && (string) $ownerId === (string) $user;
    }
}
