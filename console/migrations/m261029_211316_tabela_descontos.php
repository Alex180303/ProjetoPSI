<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_211316_tabela_descontos extends Migration
{
    public function safeUp(): void
    {
        if ($this->db->schema->getTableSchema('{{%adocao}}', true) === null) {
            throw new \yii\base\Exception('A tabela adocao ainda não existe. Cria-a antes desta migration.');
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%desconto}}', [
            'id'            => $this->primaryKey(),
            'desconto'      => $this->decimal(5, 2)->notNull(),
            'data_validade' => $this->date()->notNull(),
            'produto'       => $this->string(150)->notNull(),
            'adocao_id'     => $this->integer()->null(),
        ], $tableOptions);

        $this->createIndex('idx-desconto-validade', '{{%desconto}}', 'data_validade');
        $this->createIndex('idx-desconto-adocao', '{{%desconto}}', 'adocao_id');
        $this->addForeignKey('fk-desconto-adocao', '{{%desconto}}', 'adocao_id', '{{%adocao}}', 'id', 'CASCADE');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%desconto}}');
    }
}
