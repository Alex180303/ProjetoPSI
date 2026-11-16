<?php

declare(strict_types=1);

use common\rbac\GuestRule;
use common\rbac\Rbac;
use yii\db\Migration;
use yii\rbac\ManagerInterface;

/**
 * Cria os papéis, permissões e hierarquia do RBAC.
 *
 * Pré-requisito: tabelas do RBAC (migrações de @yii/rbac/migrations, que o
 * `yii migrate` já executa por estar configurado em console/config/main.php).
 */
class m261112_100000_rbac_papeis_permissoes extends Migration
{
    public function safeUp(): void
    {
        $auth = Yii::$app->authManager;

        // Regra para o papel visitante
        $rule = new GuestRule();
        if ($auth->getRule($rule->name) === null) {
            $auth->add($rule);
        }

        // PERMISSÕES
        $permissoes = [
            Rbac::REGISTAR_CONTA => 'Criar conta (registo no front-office)',
            Rbac::ANIMAL_CONSULTAR => 'Listar, filtrar e ver ficha de animais',
            Rbac::CONSULTAR_ASSOCIACAO => 'Ver associações, FAQ e Sobre',
            Rbac::ADOCAO_SUBMETER => 'Submeter pedido de adoção',
            Rbac::ADOCAO_CONSULTAR_PROPRIOS => 'Acompanhar pedidos próprios',
            Rbac::ANIMAL_FAVORITAR => 'Guardar favoritos',
            Rbac::PERFIL_EDITAR_PROPRIO => 'Editar perfil próprio',
            Rbac::ANIMAL_PUBLICAR => 'Criar anúncio com fotografia',
            Rbac::ANIMAL_GERIR_PROPRIOS => 'Editar anúncio e estado próprios',
            Rbac::ANIMAL_GERIR_TODOS => 'Gerir qualquer anúncio',
            Rbac::SAUDE_CONSULTAR => 'Ver ficha e histórico clínico',
            Rbac::SAUDE_GERIR_PROPRIOS => 'Gerir registos dos animais próprios',
            Rbac::CANDIDATURA_AVALIAR => 'Aprovar/recusar pedidos recebidos',
            Rbac::UTILIZADOR_GERIR => 'Gerir contas, papéis e bloqueios',
            Rbac::GERIR_CATALOGO => 'Gerir associações, espécies, raças e FAQ',
            Rbac::CONFIGURAR_SISTEMA => 'Configurar a plataforma',
            Rbac::BACKOFFICE_ACEDER => 'Aceder ao back-office',
        ];
        foreach ($permissoes as $nome => $descricao) {
            $this->permissao($auth, $nome, $descricao);
        }

        // PAPÉIS
        // visitante: utilizador não autenticado (papel por omissão + regra isGuest)
        $visitante = $this->papel($auth, Rbac::ROLE_VISITANTE, $rule->name);
        $adotante = $this->papel($auth, Rbac::ROLE_ADOTANTE);
        $anunciante = $this->papel($auth, Rbac::ROLE_ANUNCIANTE);
        $admin = $this->papel($auth, Rbac::ROLE_ADMIN);

        $this->filhos($auth, $visitante, [
            Rbac::REGISTAR_CONTA,
            Rbac::ANIMAL_CONSULTAR,
            Rbac::CONSULTAR_ASSOCIACAO,
        ]);

        $this->filhos($auth, $adotante, [
            Rbac::ANIMAL_CONSULTAR,
            Rbac::CONSULTAR_ASSOCIACAO,
            Rbac::SAUDE_CONSULTAR,
            Rbac::ADOCAO_SUBMETER,
            Rbac::ADOCAO_CONSULTAR_PROPRIOS,
            Rbac::ANIMAL_FAVORITAR,
            Rbac::PERFIL_EDITAR_PROPRIO,
        ]);

        $this->filhos($auth, $anunciante, [
            Rbac::ANIMAL_CONSULTAR,
            Rbac::CONSULTAR_ASSOCIACAO,
            Rbac::SAUDE_CONSULTAR,
            Rbac::PERFIL_EDITAR_PROPRIO,
            Rbac::ANIMAL_PUBLICAR,
            Rbac::ANIMAL_GERIR_PROPRIOS,
            Rbac::SAUDE_GERIR_PROPRIOS,
            Rbac::CANDIDATURA_AVALIAR,
            Rbac::BACKOFFICE_ACEDER,
        ]);

        // admin = anunciante + permissões de administração
        $this->filhos($auth, $admin, [
            Rbac::ANIMAL_GERIR_TODOS,
            Rbac::UTILIZADOR_GERIR,
            Rbac::GERIR_CATALOGO,
            Rbac::CONFIGURAR_SISTEMA,
            Rbac::ROLE_ANUNCIANTE,
        ]);

        // Se já existir um utilizador "admin", torna-o administrador
        $adminId = (new \yii\db\Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'admin'])
            ->scalar($this->db);
        if ($adminId !== false && $auth->getAssignment(Rbac::ROLE_ADMIN, $adminId) === null) {
            $auth->assign($admin, $adminId);
        }
    }

    public function safeDown(): void
    {
        Yii::$app->authManager->removeAll();
    }

    private function permissao(ManagerInterface $auth, string $nome, string $descricao): void
    {
        if ($auth->getPermission($nome) === null) {
            $p = $auth->createPermission($nome);
            $p->description = $descricao;
            $auth->add($p);
        }
    }

    private function papel(ManagerInterface $auth, string $nome, string|null $regra = null): \yii\rbac\Role
    {
        $role = $auth->getRole($nome);
        if ($role === null) {
            $role = $auth->createRole($nome);
            $role->ruleName = $regra;
            $auth->add($role);
        }

        return $role;
    }

    /** @param string[] $nomes nomes de permissões ou papéis filhos */
    private function filhos(ManagerInterface $auth, \yii\rbac\Role $pai, array $nomes): void
    {
        foreach ($nomes as $nome) {
            $filho = $auth->getPermission($nome) ?? $auth->getRole($nome);
            if ($filho !== null && !$auth->hasChild($pai, $filho)) {
                $auth->addChild($pai, $filho);
            }
        }
    }
}
