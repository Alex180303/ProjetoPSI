<?php

use yii\db\Migration;

class m261029_210634_tabela_favoritos extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%favorito}}', [
            'id'            => $this->primaryKey(),
            'utilizador_id' => $this->integer()->notNull(),
            'animal_id'     => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-favorito-utilizador-animal', '{{%favorito}}', ['utilizador_id', 'animal_id'], true);
        $this->createIndex('idx-favorito-animal', '{{%favorito}}', 'animal_id');

        $this->addForeignKey('fk-favorito-utilizador', '{{%favorito}}', 'utilizador_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-favorito-animal', '{{%favorito}}', 'animal_id', '{{%animal}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%favorito}}');
    }
}
