<?php

use yii\db\Migration;

class m261029_211316_tabela_descontos extends Migration
{
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('{{%adocao}}', true) === null) {
            throw new \yii\base\Exception('A tabela adocao ainda não existe. Cria-a antes desta migration.');
        }


        $this->createTable('{{%desconto}}', [
            'id'            => $this->primaryKey(),
            'desconto'      => $this->decimal(5, 2)->notNull(),   // percentagem, de 0 a 100
            'data_validade' => $this->date()->notNull(),
            'produto'       => $this->string(150)->notNull(),     // a que produto ou serviço se aplica
            'adocao_id'     => $this->integer()->null(),          // vazio = desconto geral
        ]);

        $this->createIndex('idx-desconto-validade', '{{%desconto}}', 'data_validade');
        $this->createIndex('idx-desconto-adocao', '{{%desconto}}', 'adocao_id');
        $this->addForeignKey('fk-desconto-adocao', '{{%desconto}}', 'adocao_id', '{{%adocao}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%desconto}}');
    }
}
