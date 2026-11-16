<?php

declare(strict_types=1);

use yii\db\Migration;

class m261029_200100_tabela_associacoes extends Migration
{
    public function safeUp(): void
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%associacao}}', [
            'id'        => $this->primaryKey(),
            'nome'      => $this->string(150)->notNull(),
            'morada'    => $this->string(255)->null(),
            'telefone'  => $this->string(20)->null(),
            'latitude'  => $this->decimal(10, 7)->null(),
            'longitude' => $this->decimal(10, 7)->null(),
        ], $tableOptions);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%associacao}}');
    }
}
