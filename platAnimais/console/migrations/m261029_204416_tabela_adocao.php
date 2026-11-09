<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_204416_tabela_adocao extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%adocao}}', [
            'id' => $this->primaryKey(),
            'data_submissao' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'estado' => $this->smallInteger()->notNull()->defaultValue(0),
            'animal_id'      => $this->integer()->notNull(),
            'utilizador_id'  => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-adocao-utilizador', '{{%adocao}}', 'utilizador_id');
        $this->createIndex('idx-adocao-animal', '{{%adocao}}', 'animal_id');
        $this->createIndex('idx-adocao-estado', '{{%adocao}}', 'estado');

        $this->addForeignKey('fk-adocao-utilizador', '{{%adocao}}', 'utilizador_id', '{{%user}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk-adocao-animal', '{{%adocao}}', 'animal_id', '{{%animal}}', 'id', 'RESTRICT');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%adocao}}');
    }
}
