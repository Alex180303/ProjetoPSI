<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_200000_tabela_porte extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%porte}}', [
            'id'   => $this->primaryKey(),
            'nome' => $this->string(30)->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert('{{%porte}}', ['nome'], [['Pequeno'], ['Médio'], ['Grande']]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%porte}}');
    }
}
