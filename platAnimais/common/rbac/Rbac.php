<?php

declare(strict_types=1);

namespace common\rbac;

/**
 * Classe de apoio ao RBAC (Role-Based Access Control).
 *
 * Centraliza os nomes dos PAPÉIS (roles) e PERMISSÕES (permissions) usados na aplicação.
 * Esta é a ÚNICA fonte de verdade para estes identificadores:
 * - a migração de RBAC (ex.: m261112_100000_rbac_papeis_permissoes) cria os itens na BD com estes nomes;
 * - controllers, views e regras devem referenciar sempre estas constantes (evitar strings soltas),
 *   para facilitar manutenção e evitar erros de digitação.
 *
 * Integração Yii2:
 * - O componente `authManager` (normalmente DbManager) guarda papéis, permissões, hierarquias e atribuições.
 * - `AccessControl` nos controllers valida acesso com 'roles' => ['@'] ou 'permissions' => [Rbac::...].
 */
class Rbac
{
    // ---------------------------------------------------------------------
    // Papéis (roles) atribuídos a utilizadores via authManager (tabela auth_assignment)
    // ---------------------------------------------------------------------

    /** Papel para utilizadores não autenticados (aplicado como defaultRole no frontend, com GuestRule). */
    public const ROLE_VISITANTE = 'visitante';

    /** Papel de utilizador que pode consultar e candidatar-se a adoções, gerir favoritos/perfil, etc. */
    public const ROLE_ADOTANTE = 'adotante';

    /** Papel de utilizador/entidade que pode publicar e gerir os seus próprios anúncios/animais. */
    public const ROLE_ANUNCIANTE = 'anunciante';

    /** Papel de administrador com acesso amplo ao backoffice e gestão do sistema. */
    public const ROLE_ADMIN = 'admin';

    // ---------------------------------------------------------------------
    // Permissões (permissions) — formato verbo-primeiro, associadas a papéis na migração RBAC
    // ---------------------------------------------------------------------

    // Conta e navegação pública/autenticada
    /** Permite aceder ao formulário de registo de conta (tipicamente apenas visitantes). */
    public const REGISTAR_CONTA = 'registarConta';
    /** Permite consultar informação sobre associações no frontend. */
    public const CONSULTAR_ASSOCIACAO = 'consultarAssociacao';

    // Catálogos e configuração (backoffice)
    /** Permite gerir catálogos base (ex.: espécies, raças, portes, associações) no backoffice. */
    public const GERIR_CATALOGO = 'gerirCatalogo';
    /** Permite configurar aspetos do sistema (ex.: descontos, notificações) no backoffice. */
    public const CONFIGURAR_SISTEMA = 'configurarSistema';

    // Animais
    /** Permite consultar/listar/detalhar animais. */
    public const ANIMAL_CONSULTAR = 'consultarAnimal';
    /** Permite publicar/criar novos registos de animais. */
    public const ANIMAL_PUBLICAR = 'publicarAnimal';
    /** Permite marcar animais como favoritos (funcionalidade de utilizador). */
    public const ANIMAL_FAVORITAR = 'favoritarAnimal';
    /** Permite gerir apenas os animais próprios do utilizador/anunciante. */
    public const ANIMAL_GERIR_PROPRIOS = 'gerirAnimaisProprios';
    /** Permite gerir todos os animais (admin/backoffice). */
    public const ANIMAL_GERIR_TODOS = 'gerirTodosAnimais';

    // Adoções / candidaturas
    /** Permite submeter um pedido/candidatura de adoção. */
    public const ADOCAO_SUBMETER = 'submeterAdocao';
    /** Permite consultar as próprias candidaturas/adoções submetidas. */
    public const ADOCAO_CONSULTAR_PROPRIOS = 'consultarAdocoesProprias';
    /** Permite avaliar/aprovar/recusar candidaturas de adoção no backoffice. */
    public const CANDIDATURA_AVALIAR = 'avaliarCandidatura';

    // Saúde (fichas clínicas)
    /** Permite consultar informação de saúde/fichas clínicas. */
    public const SAUDE_CONSULTAR = 'consultarSaude';
    /** Permite criar/editar/eliminar fichas clínicas dos próprios animais/contexto permitido. */
    public const SAUDE_GERIR_PROPRIOS = 'gerirSaudeProprios';

    // Perfil e utilizadores
    /** Permite editar o próprio perfil de utilizador. */
    public const PERFIL_EDITAR_PROPRIO = 'editarPerfilProprio';
    /** Permite gerir perfis/utilizadores no backoffice. */
    public const UTILIZADOR_GERIR = 'gerirUtilizadores';

    // Backoffice
    /** Permite aceder à área de backoffice (ex.: dashboard inicial do backend). */
    public const BACKOFFICE_ACEDER = 'acederBackoffice';
}
