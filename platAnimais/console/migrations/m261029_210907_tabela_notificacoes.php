<?php

use yii\db\Migration;

class m261029_210907_tabela_notificacoes extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notificacao}}', [
            'id'            => $this->primaryKey(),
            'mensagem'      => $this->text()->notNull(),
            'utilizador_id' => $this->integer()->null(),
        ], $tableOptions);

        $this->createIndex('idx-notificacao-utilizador', '{{%notificacao}}', 'utilizador_id');
        $this->addForeignKey('fk-notificacao-utilizador', '{{%notificacao}}', 'utilizador_id', '{{%user}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%notificacao}}');
    }
}
