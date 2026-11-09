<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_200223_tabela_animais extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%animal}}', [
            'id'            => $this->primaryKey(),
            'nome'          => $this->string(100)->notNull(),
            'idade'         => $this->integer()->null(),
            'sexo'          => $this->smallInteger()->notNull(),
            'cor'           => $this->string(50)->null(),
            'descricao'     => $this->text()->null(),
            'porte_id'      => $this->integer()->null(),
            'especie_id'    => $this->integer()->notNull(),
            'raca_id'       => $this->integer()->null(),
            'utilizador_id' => $this->integer()->null(),
            'associacao_id' => $this->integer()->null(),
        ], $tableOptions);

        $this->createIndex('idx-animal-especie', '{{%animal}}', 'especie_id');
        $this->createIndex('idx-animal-raca', '{{%animal}}', ['raca_id', 'especie_id']);
        $this->createIndex('idx-animal-utilizador', '{{%animal}}', 'utilizador_id');
        $this->createIndex('idx-animal-associacao', '{{%animal}}', 'associacao_id');
        $this->createIndex('idx-animal-porte', '{{%animal}}', 'porte_id');

        $this->addForeignKey('fk-animal-especie', '{{%animal}}', 'especie_id', '{{%especie}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk-animal-raca', '{{%animal}}', ['raca_id', 'especie_id'], '{{%raca}}', ['id', 'especie_id'], 'RESTRICT');
        $this->addForeignKey('fk-animal-utilizador', '{{%animal}}', 'utilizador_id', '{{%user}}', 'id', 'SET NULL');
        $this->addForeignKey('fk-animal-associacao', '{{%animal}}', 'associacao_id', '{{%associacao}}', 'id', 'SET NULL');
        $this->addForeignKey('fk-animal-porte', '{{%animal}}', 'porte_id', '{{%porte}}', 'id', 'RESTRICT');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%animal}}');
    }
}
