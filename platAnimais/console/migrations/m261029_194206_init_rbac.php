<?php

declare(strict_types=1);

use common\rbac\RbacInitializer;
use yii\db\Migration;

/**
 * Inicializa a árvore RBAC definida na Matriz de permissões da plataforma.
 *
 * Os papéis e permissões são definidos em common/rbac/Rbac.php e construídos
 * por common/rbac/RbacInitializer.php. As atribuições de papéis a utilizadores
 * não são feitas aqui (ver `yii rbac/assign`), para não acoplar dados de
 * utilizadores à migração.
 */
class m261029_194206_init_rbac extends Migration
{
    public function safeUp(): void
    {
        RbacInitializer::build(Yii::$app->authManager);
    }

    public function safeDown(): void
    {
        RbacInitializer::remove(Yii::$app->authManager);
    }
}
