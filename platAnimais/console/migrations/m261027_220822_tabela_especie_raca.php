<?php

use yii\db\Migration;

class m261027_220822_tabela_especie_raca extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%especie}}', [
            'id'   => $this->primaryKey(),
            'nome' => $this->string(50)->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('{{%raca}}', [
            'id'         => $this->primaryKey(),
            'nome'       => $this->string(80)->notNull(),
            'especie_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-raca-especie-nome', '{{%raca}}', ['especie_id', 'nome'], true);
        $this->createIndex('idx-raca-id-especie', '{{%raca}}', ['id', 'especie_id'], true);
        $this->addForeignKey('fk-raca-especie', '{{%raca}}', 'especie_id', '{{%especie}}', 'id', 'RESTRICT');

        $this->batchInsert('{{%especie}}', ['nome'], [['Cão'], ['Gato'], ['Passaro'], ['Hamster'], ['Coelho']]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%raca}}');
        $this->dropTable('{{%especie}}');
    }
}