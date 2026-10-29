<?php

use yii\db\Migration;

class m261029_205109_tabela_porte extends Migration
{
    public function safeUp()
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

    public function safeDown()
    {
        $this->dropTable('{{%porte}}');
    }
}
