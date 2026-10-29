<?php

use yii\db\Migration;

class m261029_213450_tabela_perfil extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%perfil}}', [
            'id'            => $this->primaryKey(),
            'utilizador_id' => $this->integer()->notNull(),
            'nome'          => $this->string(100)->notNull(),
            'tipo'          => $this->smallInteger()->notNull()->defaultValue(0),
            'biometria'     => $this->boolean()->notNull()->defaultValue(0),
            'associacao_id' => $this->integer()->null(),
        ]);

        $this->createIndex('idx-perfil-utilizador', '{{%perfil}}', 'utilizador_id', true);
        $this->createIndex('idx-perfil-associacao', '{{%perfil}}', 'associacao_id');
        $this->addForeignKey('fk-perfil-utilizador', '{{%perfil}}', 'utilizador_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-perfil-associacao', '{{%perfil}}', 'associacao_id', '{{%associacao}}', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropTable('{{%perfil}}');
    }
}
