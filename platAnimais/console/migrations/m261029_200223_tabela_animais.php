<?php

use yii\db\Migration;

class m261029_200223_tabela_animais extends Migration
{
    public function safeUp()
    {


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
        ]);

        $this->createIndex('idx-animal-especie', '{{%animal}}', 'especie_id');
        $this->createIndex('idx-animal-utilizador', '{{%animal}}', 'utilizador_id');
        $this->createIndex('idx-animal-associacao', '{{%animal}}', 'associacao_id');

        $this->addForeignKey('fk-animal-especie', '{{%animal}}', 'especie_id', '{{%especie}}', 'id', 'RESTRICT');

        $this->addForeignKey('fk-animal-raca', '{{%animal}}', ['raca_id', 'especie_id'], '{{%raca}}', ['id', 'especie_id'], 'RESTRICT');
        $this->addForeignKey('fk-animal-utilizador', '{{%animal}}', 'utilizador_id', '{{%user}}', 'id', 'SET NULL');

        $this->createIndex('idx-animal-porte', '{{%animal}}', 'porte_id');
        $this->addForeignKey('fk-animal-porte', '{{%animal}}', 'porte_id', '{{%porte}}', 'id', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%animal}}');
    }
}
