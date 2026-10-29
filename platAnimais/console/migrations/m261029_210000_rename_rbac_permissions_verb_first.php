<?php

declare(strict_types=1);

use common\rbac\RbacInitializer;
use yii\db\Migration;

/**
 * Renomeia as permissões para a convenção "verbo primeiro".
 *
 * Os nomes antigos (recurso/verbo, ex.: animal/consultar) são removidos e a
 * árvore é reconstruída com os novos nomes (ex.: consultarAnimal). As
 * atribuições de papéis aos utilizadores são preservadas.
 */
class m261029_210000_rename_rbac_permissions_verb_first extends Migration
{
    private const OLD_PERMISSIONS = [
        'animal/consultar',
        'associacao/consultar',
        'conta/registar',
        'adocao/submeter',
        'adocao/consultarProprios',
        'animal/favoritar',
        'perfil/editarProprio',
        'animal/publicar',
        'animal/gerirProprios',
        'animal/gerirTodos',
        'saude/consultar',
        'saude/gerirProprios',
        'candidatura/avaliar',
        'utilizador/gerir',
        'catalogo/gerir',
        'sistema/configurar',
    ];

    public function safeUp(): void
    {
        $auth = Yii::$app->authManager;

        foreach (self::OLD_PERMISSIONS as $name) {
            $permission = $auth->getPermission($name);

            if ($permission !== null) {
                $auth->remove($permission);
            }
        }

        RbacInitializer::build($auth);
    }

    public function safeDown()
    {
        echo "m261029_210000_rename_rbac_permissions_verb_first cannot be reverted.\n";

        return false;
    }
}
