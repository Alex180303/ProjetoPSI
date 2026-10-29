<?php
use yii\db\Migration;

class m170124_084304_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // PERMISSÕES (IDs da matriz RBAC)
        // O "Visitante" é o utilizador não autenticado ("?"), por isso não
        // tem papel nem conta/registar é criada aqui.

        // Adiciona as permissões "animal/consultar"
        $consultarAnimal = $auth->createPermission('animalConsultar');
        $consultarAnimal->description = 'Listar, filtrar e ver ficha de animais';
        $auth->add($consultarAnimal);

        // Adiciona as permissões "associacao/consultar"
        $consultarAssociacao = $auth->createPermission('associacaoConsultar');
        $consultarAssociacao->description = 'Ver associações, FAQ e Sobre';
        $auth->add($consultarAssociacao);

        // Adiciona as permissões"adocao/submeter"
        $submeterAdocao = $auth->createPermission('adocaoSubmeter');
        $submeterAdocao->description = 'Submeter pedido de adoção';
        $auth->add($submeterAdocao);

        // Adiciona as permissões"adocao/consultarProprios"
        $consultarAdocaoProprios = $auth->createPermission('adocaoConsultarProprios');
        $consultarAdocaoProprios->description = 'Acompanhar pedidos próprios';
        $auth->add($consultarAdocaoProprios);

        // Adiciona as permissões"animal/favoritar"
        $favoritarAnimal = $auth->createPermission('animalFavoritar');
        $favoritarAnimal->description = 'Guardar favoritos';
        $auth->add($favoritarAnimal);

        // Adiciona as permissões"perfil/editarProprio"
        $editarPerfilProprio = $auth->createPermission('perfilEditarProprio');
        $editarPerfilProprio->description = 'Editar perfil próprio';
        $auth->add($editarPerfilProprio);

        // Adiciona as permissões"animal/publicar"
        $publicarAnimal = $auth->createPermission('animalPublicar');
        $publicarAnimal->description = 'Criar anúncio com fotografia';
        $auth->add($publicarAnimal);

        // Adiciona as permissões"animal/gerirProprios"
        $gerirAnimalProprios = $auth->createPermission('animalGerirProprios');
        $gerirAnimalProprios->description = 'Editar anúncio e estado próprios';
        $auth->add($gerirAnimalProprios);

        // Adiciona as permissões "animal/gerirTodos"
        $gerirAnimalTodos = $auth->createPermission('animalGerirTodos');
        $gerirAnimalTodos->description = 'Gerir qualquer anúncio';
        $auth->add($gerirAnimalTodos);

        // Adiciona as permissões "saude/consultar"
        $consultarSaude = $auth->createPermission('saudeConsultar');
        $consultarSaude->description = 'Ver ficha e histórico clínico';
        $auth->add($consultarSaude);

        // Adiciona as permissões "saude/gerirProprios"
        $gerirSaudeProprios = $auth->createPermission('saudeGerirProprios');
        $gerirSaudeProprios->description = 'Gerir registos dos animais próprios';
        $auth->add($gerirSaudeProprios);

        // Adiciona as permissões "candidatura/avaliar"
        $avaliarCandidatura = $auth->createPermission('candidaturaAvaliar');
        $avaliarCandidatura->description = 'Aprovar/recusar pedidos recebidos';
        $auth->add($avaliarCandidatura);

        // Adiciona as permissões "utilizador/gerir"
        $gerirUtilizador = $auth->createPermission('utilizadorGerir');
        $gerirUtilizador->description = 'Gerir contas, papéis e bloqueios';
        $auth->add($gerirUtilizador);

        // Adiciona as permissões "catalogo/gerir"
        $gerirCatalogo = $auth->createPermission('catalogoGerir');
        $gerirCatalogo->description = 'Gerir associações, espécies, raças e FAQ';
        $auth->add($gerirCatalogo);

        // Adiciona as permissões "sistema/configurar"
        $configurarSistema = $auth->createPermission('sistemaConfigurar');
        $configurarSistema->description = 'Configurar a plataforma';
        $auth->add($configurarSistema);

        // PAPÉIS

        // Adiciona o role "adotante" e adiciona as permissoes a essa role
        $adotante = $auth->createRole('adotante');
        $auth->add($adotante);
        $auth->addChild($adotante, $consultarAnimal);
        $auth->addChild($adotante, $consultarAssociacao);
        $auth->addChild($adotante, $consultarSaude);
        $auth->addChild($adotante, $submeterAdocao);
        $auth->addChild($adotante, $consultarAdocaoProprios);
        $auth->addChild($adotante, $favoritarAnimal);
        $auth->addChild($adotante, $editarPerfilProprio);

        // Adiciona o role "anunciante" e adiciona as permissoes a essa role
        $anunciante = $auth->createRole('anunciante');
        $auth->add($anunciante);
        $auth->addChild($anunciante, $consultarAnimal);
        $auth->addChild($anunciante, $consultarAssociacao);
        $auth->addChild($anunciante, $consultarSaude);
        $auth->addChild($anunciante, $editarPerfilProprio);
        $auth->addChild($anunciante, $publicarAnimal);
        $auth->addChild($anunciante, $gerirAnimalProprios);
        $auth->addChild($anunciante, $gerirSaudeProprios);
        $auth->addChild($anunciante, $avaliarCandidatura);

        // Adiciona o role "admin" e adiciona as permissoes a essa role
        // e as permissoes da role "anunciante"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $gerirAnimalTodos);
        $auth->addChild($admin, $gerirUtilizador);
        $auth->addChild($admin, $gerirCatalogo);
        $auth->addChild($admin, $configurarSistema);
        $auth->addChild($admin, $anunciante);

        // Atribuir as roles aos users. 1, 2 e 3, IDS sao returnados por IdentityInterface::getId()
        // que vai ser implementada no model do user.
        $auth->assign($admin, 1);
        $auth->assign($anunciante, 2);
        $auth->assign($adotante, 3);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}