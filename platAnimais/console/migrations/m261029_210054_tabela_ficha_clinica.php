<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_210054_tabela_ficha_clinica extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ficha_clinica}}', [
            'id'               => $this->primaryKey(),
            'animal_id'        => $this->integer()->notNull(),
            'vacinacao'        => $this->text()->null(),
            'desparasitacao'   => $this->text()->null(),
            'esterilizacao'    => $this->boolean()->notNull()->defaultValue(0),
            'historico_medico' => $this->text()->null(),
        ], $tableOptions);

        $this->createIndex('idx-ficha_clinica-animal', '{{%ficha_clinica}}', 'animal_id', true);
        $this->addForeignKey('fk-ficha_clinica-animal', '{{%ficha_clinica}}', 'animal_id', '{{%animal}}', 'id', 'CASCADE');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%ficha_clinica}}');
    }
}
