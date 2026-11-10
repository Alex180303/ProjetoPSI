<?php

use yii\db\Migration;

class m261110_214144_rbac_publicar_animal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        //Papel anunciante (cria-o se ainda não existir)
        $anunciante= $auth->getRole('anunciante');
        if($anunciante === null) {
            $anunciante = $auth->createRole('anunciante');
            $auth->add($anunciante);
        }

        //permissão publicarAnimal
        $publicar = $auth->getPermission(Rbac::ANIMAL_PUBLICAR);

        if($publicar === null) {
            // A migração original criava-a como "animalPublicar": renomeia
            $antiga = $auth->getPermission('animalPublicar');

            if ($antiga !== null) {
                $antiga->name = Rbac::ANIMAL_PUBLICAR;
                $auth->update('animalPublicar', $antiga);
                $publicar = $antiga;
            }else{
                $publicar = $auth->createPermission(Rbac::ANIMAL_PUBLICAR);
                $publicar->description = 'Criar anúncio com fotografia';
                $auth->add($)
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m261110_214144_rbac_publicar_animal cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261110_214144_rbac_publicar_animal cannot be reverted.\n";

        return false;
    }
    */
}
