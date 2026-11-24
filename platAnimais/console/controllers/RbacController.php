<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // ATENÇÃO: remove todos os papéis, permissões,
        // relações, regras e atribuições RBAC existentes.
        // Usa esta linha apenas se quiseres reconstruir tudo.
        $auth->removeAll();

        // Criar permissões
        $consultarAnimal = $auth->createPermission('consultarAnimal');
        $consultarAnimal->description = 'Consultar animal';
        $auth->add($consultarAnimal);

        $consultarAssociacao = $auth->createPermission('consultarAssociacao');
        $consultarAssociacao->description = 'Consultar associação';
        $auth->add($consultarAssociacao);

        $pedirAdocao = $auth->createPermission('pedirAdocao');
        $pedirAdocao->description = 'Pedir adoção';
        $auth->add($pedirAdocao);

        $consultarAdocoesProprias = $auth->createPermission('consultarAdocoesProprias');
        $consultarAdocoesProprias->description = 'Consultar adoções';
        $auth->add($consultarAdocoesProprias);

        $favoritarAnimal = $auth->createPermission('favoritarAnimal');
        $favoritarAnimal->description = 'Adicionar animal a favoritos';
        $auth->add($favoritarAnimal);

        $editarPerfilProprio = $auth->createPermission('editarPerfilProprio');
        $editarPerfilProprio->description = 'Editar perfil';
        $auth->add($editarPerfilProprio);

        $criarAnimal = $auth->createPermission('criarAnimal');
        $criarAnimal->description = 'Criar animal';
        $auth->add($criarAnimal);

        $editarAnimalProprio = $auth->createPermission('editarAnimalProprio');
         $editarAnimalProprio->description = 'Editar animal';
        $auth->add($editarAnimalProprio);

        $eliminarAnimalProprio = $auth->createPermission('eliminarAnimalProprio');
        $eliminarAnimalProprio->description = 'Eliminar animal';
        $auth->add($eliminarAnimalProprio);

        $consultarSaude = $auth->createPermission('consultarSaude');
        $consultarSaude->description = 'Consultar saude';
        $auth->add($consultarSaude);

        $criarRegistoSaude = $auth->createPermission('criarRegistoSaude');
        $criarRegistoSaude->description = 'Criar registo de saude';
        $auth->add($criarRegistoSaude);

        $editarRegistoSaudeProprio = $auth->createPermission('editarRegistoSaudeProprio');
        $editarRegistoSaudeProprio->description = 'Editar registo de saude';
        $auth->add($editarRegistoSaudeProprio);

        $eliminarRegistoSaudeProprio = $auth->createPermission('eliminarRegistoSaudeProprio');
        $eliminarRegistoSaudeProprio->description = 'Eliminar registo de saude';
        $auth->add($eliminarRegistoSaudeProprio);

        $avaliarCandidatura = $auth->createPermission('avaliarCandidatura');
        $avaliarCandidatura->description = 'Avaliar candidatura';
        $auth->add($avaliarCandidatura);

        $editarQualquerAnimal = $auth->createPermission('editarQualquerAnimal');
        $editarQualquerAnimal->description = 'Editar animal';
        $auth->add($editarQualquerAnimal);

        $eliminarQualquerAnimal = $auth->createPermission('eliminarQualquerAnimal');
        $eliminarQualquerAnimal->description = 'Eliminar animal';
        $auth->add($eliminarQualquerAnimal);

        $gerirUtilizadores = $auth->createPermission('gerirUtilizadores');
        $gerirUtilizadores->description = 'Gerir utilizadores';
        $auth->add($gerirUtilizadores);

        $gerirCatalogo = $auth->createPermission('gerirCatalogo');
        $gerirCatalogo->description = 'Gerir catalogo';
        $auth->add($gerirCatalogo);

        $configurarSistema = $auth->createPermission('configurarSistema');
        $configurarSistema->description = 'Configurar sistema';
        $auth->add($configurarSistema);


        // Criar papéis
        $adotante = $auth->createRole('adotante');
        $auth->add($adotante);
        // Ligar permissões ao papel adotante
        $auth->addChild($adotante, $consultarAnimal);
        $auth->addChild($adotante, $consultarAssociacao);
        $auth->addChild($adotante, $pedirAdocao);
        $auth->addChild($adotante, $consultarAdocoesProprias);
        $auth->addChild($adotante, $favoritarAnimal);
        $auth->addChild($adotante, $editarPerfilProprio);
        $auth->addChild($adotante, $consultarSaude);


        $anunciante = $auth->createRole('anunciante');
        $auth->add($anunciante);
        // Ligar permissões ao papel anunciante
        $auth->addChild($anunciante, $consultarAnimal);
        $auth->addChild($anunciante, $consultarAssociacao);
        $auth->addChild($anunciante, $editarPerfilProprio);
        $auth->addChild($anunciante, $criarAnimal);
        $auth->addChild($anunciante, $editarAnimalProprio);
        $auth->addChild($anunciante, $eliminarAnimalProprio);
        $auth->addChild($anunciante, $consultarSaude);
        $auth->addChild($anunciante, $criarRegistoSaude);
        $auth->addChild($anunciante, $editarRegistoSaudeProprio);
        $auth->addChild($anunciante, $eliminarRegistoSaudeProprio);
        $auth->addChild($anunciante, $avaliarCandidatura);

        $associacao = $auth->createRole('associacao');
        $auth->add($associacao);
        // Ligar permissões ao papel associação
        $auth->addChild($associacao, $consultarAnimal);
        $auth->addChild($associacao, $consultarAssociacao);
        $auth->addChild($associacao, $editarPerfilProprio);
        $auth->addChild($associacao, $criarAnimal);
        $auth->addChild($associacao, $editarAnimalProprio);
        $auth->addChild($associacao, $eliminarAnimalProprio);
        $auth->addChild($associacao, $consultarSaude);
        $auth->addChild($associacao, $criarRegistoSaude);
        $auth->addChild($associacao, $editarRegistoSaudeProprio);
        $auth->addChild($associacao, $eliminarRegistoSaudeProprio);
        $auth->addChild($associacao, $avaliarCandidatura);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $acederBackoffice = $auth->createPermission('acederBackoffice');
        $acederBackoffice->description = 'Aceder ao backoffice';
        $auth->add($acederBackoffice);


// Ligar permissões ao papel admin
        $auth->addChild($admin, $consultarAnimal);
        $auth->addChild($admin, $consultarAssociacao);
        $auth->addChild($admin, $editarPerfilProprio);
        $auth->addChild($admin, $criarAnimal);
        $auth->addChild($admin, $editarAnimalProprio);
        $auth->addChild($admin, $eliminarAnimalProprio);
        $auth->addChild($admin, $editarQualquerAnimal);
        $auth->addChild($admin, $eliminarQualquerAnimal);
        $auth->addChild($admin, $consultarSaude);
        $auth->addChild($admin, $criarRegistoSaude);
        $auth->addChild($admin, $editarRegistoSaudeProprio);
        $auth->addChild($admin, $eliminarRegistoSaudeProprio);
        $auth->addChild($admin, $avaliarCandidatura);
        $auth->addChild($admin, $gerirUtilizadores);
        $auth->addChild($admin, $gerirCatalogo);
        $auth->addChild($admin, $configurarSistema);
        $auth->addChild($associacao, $acederBackoffice);
        $auth->addChild($admin, $acederBackoffice);

        echo "RBAC inicializado.\n";
        return ExitCode::OK;
    }
        public function actionAssign(string $username, string $role): int
    {
        $auth = Yii::$app->authManager;
        $user = \common\models\User::findByUsername($username);
        $papel = $auth->getRole($role);

        if (!$user || !$papel) {
            echo "Utilizador ou papel não encontrado.\n";
            return ExitCode::DATAERR;
        }

        $auth->assign($papel, $user->getId());
        echo "Papel '$role' atribuído a '$username'.\n";
        return ExitCode::OK;
    }
}