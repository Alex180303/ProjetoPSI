<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_210634_tabela_favoritos extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%favorito}}', [
            'id'            => $this->primaryKey(),
            'utilizador_id' => $this->integer()->notNull(),
            'animal_id'     => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-favorito-utilizador-animal', '{{%favorito}}', ['utilizador_id', 'animal_id'], true);
        $this->createIndex('idx-favorito-animal', '{{%favorito}}', 'animal_id');

        $this->addForeignKey('fk-favorito-utilizador', '{{%favorito}}', 'utilizador_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-favorito-animal', '{{%favorito}}', 'animal_id', '{{%animal}}', 'id', 'CASCADE');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%favorito}}');
    }
}
