<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_213450_tabela_perfil extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%perfil}}', [
            'id'            => $this->primaryKey(),
            'utilizador_id' => $this->integer()->notNull(),
            'nome'          => $this->string(100)->notNull(),
            'tipo'          => $this->smallInteger()->notNull()->defaultValue(0),
            'biometria'     => $this->boolean()->notNull()->defaultValue(0),
            'associacao_id' => $this->integer()->null(),
        ], $tableOptions);

        $this->createIndex('idx-perfil-utilizador', '{{%perfil}}', 'utilizador_id', true);
        $this->createIndex('idx-perfil-associacao', '{{%perfil}}', 'associacao_id');
        $this->addForeignKey('fk-perfil-utilizador', '{{%perfil}}', 'utilizador_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-perfil-associacao', '{{%perfil}}', 'associacao_id', '{{%associacao}}', 'id', 'SET NULL');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%perfil}}');
    }
}
