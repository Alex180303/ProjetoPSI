<?php

declare(strict_types=1);

namespace common\rbac;

use yii\rbac\ManagerInterface;
use yii\rbac\Permission;
use yii\rbac\Role;

/**
 * Constrói a árvore RBAC definida na Matriz de permissões da plataforma.
 *
 * É usada pela migração (instalações novas) e pelo comando `yii rbac/init`
 * (atualização de uma base existente). A construção é idempotente: itens já
 * existentes são atualizados em vez de duplicados, e as atribuições de papéis
 * a utilizadores são preservadas.
 */
final class RbacInitializer
{
    public static function build(ManagerInterface $auth, bool $removeStale = false): void
    {
        if ($removeStale) {
            self::remove($auth);
        }

        $guestRule = self::addRule($auth, new GuestRule());
        $ownRule = self::addRule($auth, new OwnRecordRule());

        foreach (Rbac::permissions() as $name => $description) {
            $isOwn = in_array($name, Rbac::ownPermissions(), true);
            $permission = $auth->getPermission($name);

            if ($permission === null) {
                $permission = $auth->createPermission($name);
                $permission->description = $description;
                $permission->ruleName = $isOwn ? $ownRule->name : null;
                $auth->add($permission);
                continue;
            }

            $permission->description = $description;
            $permission->ruleName = $isOwn ? $ownRule->name : null;
            $auth->update($name, $permission);
        }

        $visitante = self::role($auth, Rbac::ROLE_VISITANTE, $guestRule->name);
        $adotante = self::role($auth, Rbac::ROLE_ADOTANTE);
        $anunciante = self::role($auth, Rbac::ROLE_ANUNCIANTE);
        $admin = self::role($auth, Rbac::ROLE_ADMIN);

        // Visitante: consulta pública + criação de conta.
        self::grant($auth, $visitante, [
            Rbac::CONSULTAR_ANIMAL,
            Rbac::CONSULTAR_ASSOCIACAO,
            Rbac::CONSULTAR_SAUDE,
            Rbac::REGISTAR_CONTA,
        ]);

        // Adotante: consulta + pedidos, favoritos e perfil próprio.
        self::grant($auth, $adotante, [
            Rbac::CONSULTAR_ANIMAL,
            Rbac::CONSULTAR_ASSOCIACAO,
            Rbac::CONSULTAR_SAUDE,
            Rbac::SUBMETER_ADOCAO,
            Rbac::CONSULTAR_ADOCOES_PROPRIAS,
            Rbac::FAVORITAR_ANIMAL,
            Rbac::EDITAR_PERFIL_PROPRIO,
        ]);

        // Anunciante / associação: publica e gere os seus animais e candidaturas.
        self::grant($auth, $anunciante, [
            Rbac::CONSULTAR_ANIMAL,
            Rbac::CONSULTAR_ASSOCIACAO,
            Rbac::CONSULTAR_SAUDE,
            Rbac::EDITAR_PERFIL_PROPRIO,
            Rbac::PUBLICAR_ANIMAL,
            Rbac::GERIR_ANIMAIS_PROPRIOS,
            Rbac::GERIR_SAUDE_PROPRIOS,
            Rbac::AVALIAR_CANDIDATURA,
        ]);

        // Admin: herda tudo o que o anunciante pode fazer e acrescenta a gestão global.
        if (!$auth->hasChild($admin, $anunciante)) {
            $auth->addChild($admin, $anunciante);
        }

        self::grant($auth, $admin, [
            Rbac::GERIR_TODOS_ANIMAIS,
            Rbac::GERIR_UTILIZADORES,
            Rbac::GERIR_CATALOGO,
            Rbac::CONFIGURAR_SISTEMA,
        ]);
    }

    /**
     * Remove todos os itens e regras geridos por esta aplicação.
     *
     * Nota: não remove itens de terceiros nem atribuições de papéis que não
     * pertençam à matriz. Para apagar toda a árvore RBAC use o removeAll() do
     * authManager (opção `yii rbac/reset`).
     */
    public static function remove(ManagerInterface $auth): void
    {
        foreach (array_keys(Rbac::roles()) as $name) {
            $role = $auth->getRole($name);
            if ($role !== null) {
                $auth->remove($role);
            }
        }

        foreach (array_keys(Rbac::permissions()) as $name) {
            $permission = $auth->getPermission($name);
            if ($permission !== null) {
                $auth->remove($permission);
            }
        }

        foreach ([GuestRule::class, OwnRecordRule::class] as $ruleClass) {
            $rule = new $ruleClass();
            if ($auth->getRule($rule->name) !== null) {
                $auth->remove($rule);
            }
        }
    }

    /**
     * Apaga toda a árvore RBAC (incluindo atribuições) e reconstrói a matriz.
     */
    public static function reset(ManagerInterface $auth): void
    {
        $auth->removeAll();
        self::build($auth);
    }

    private static function addRule(ManagerInterface $auth, \yii\rbac\Rule $rule): \yii\rbac\Rule
    {
        $existing = $auth->getRule($rule->name);

        if ($existing === null) {
            $auth->add($rule);
            return $rule;
        }

        if ($existing::class !== $rule::class) {
            $auth->update($rule->name, $rule);
            return $rule;
        }

        return $existing;
    }

    private static function role(ManagerInterface $auth, string $name, ?string $ruleName = null): Role
    {
        $role = $auth->getRole($name);

        if ($role === null) {
            $role = $auth->createRole($name);
            $role->description = Rbac::roles()[$name];
            $role->ruleName = $ruleName;
            $auth->add($role);

            return $role;
        }

        $role->description = Rbac::roles()[$name];
        $role->ruleName = $ruleName;
        $auth->update($name, $role);

        return $role;
    }

    /**
     * @param string[] $permissionNames
     */
    private static function grant(ManagerInterface $auth, Role $role, array $permissionNames): void
    {
        foreach ($permissionNames as $permissionName) {
            /** @var Permission|null $permission */
            $permission = $auth->getPermission($permissionName);

            if ($permission === null || $auth->hasChild($role, $permission)) {
                continue;
            }

            $auth->addChild($role, $permission);
        }
    }
}
