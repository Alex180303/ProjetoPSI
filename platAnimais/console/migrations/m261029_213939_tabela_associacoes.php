<?php

use yii\db\Migration;

class m261029_213939_tabela_associacoes extends Migration
{
    public function safeUp()
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

    public function safeDown()
    {
        $this->dropTable('{{%associacao}}');
    }
}
