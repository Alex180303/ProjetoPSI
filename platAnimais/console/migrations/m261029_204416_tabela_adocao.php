<?php

use yii\db\Migration;

class m261029_204416_tabela_adocao extends Migration
{
    public function safeUp()
    {

        $this->createTable('{{%adocao}}', [
            'id' => $this->primaryKey(),
            'data_submissao' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'estado' => $this->smallInteger()->notNull()->defaultValue(0),
            'animal_id'      => $this->integer()->notNull(),
            'utilizador_id'  => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-adocao-utilizador', '{{%adocao}}', 'utilizador_id');
        $this->createIndex('idx-adocao-animal', '{{%adocao}}', 'animal_id');
        $this->createIndex('idx-adocao-estado', '{{%adocao}}', 'estado');

        $this->addForeignKey('fk-adocao-utilizador', '{{%adocao}}', 'utilizador_id', '{{%user}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk-adocao-animal', '{{%adocao}}', 'animal_id', '{{%animal}}', 'id', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%adocao}}');
    }
}