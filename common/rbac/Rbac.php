<?php

declare(strict_types=1);

namespace common\rbac;

/**
 * Nomes dos papéis e permissões do RBAC.
 *
 * Esta classe é a ÚNICA fonte de verdade: a migração de RBAC
 * (m261112_100000_rbac_papeis_permissoes) cria os itens com estes nomes e os
 * controllers/views devem usar sempre estas constantes (nunca strings soltas).
 */
class Rbac
{
    // Papéis
    public const ROLE_VISITANTE = 'visitante';
    public const ROLE_ADOTANTE = 'adotante';
    public const ROLE_ANUNCIANTE = 'anunciante';
    public const ROLE_ADMIN = 'admin';

    // Permissões (formato verbo-primeiro)
    public const REGISTAR_CONTA = 'registarConta';
    public const CONSULTAR_ASSOCIACAO = 'consultarAssociacao';
    public const GERIR_CATALOGO = 'gerirCatalogo';
    public const CONFIGURAR_SISTEMA = 'configurarSistema';
    public const ANIMAL_CONSULTAR = 'consultarAnimal';
    public const ANIMAL_PUBLICAR = 'publicarAnimal';
    public const ANIMAL_FAVORITAR = 'favoritarAnimal';
    public const ANIMAL_GERIR_PROPRIOS = 'gerirAnimaisProprios';
    public const ANIMAL_GERIR_TODOS = 'gerirTodosAnimais';
    public const ADOCAO_SUBMETER = 'submeterAdocao';
    public const ADOCAO_CONSULTAR_PROPRIOS = 'consultarAdocoesProprias';
    public const CANDIDATURA_AVALIAR = 'avaliarCandidatura';
    public const SAUDE_CONSULTAR = 'consultarSaude';
    public const SAUDE_GERIR_PROPRIOS = 'gerirSaudeProprios';
    public const PERFIL_EDITAR_PROPRIO = 'editarPerfilProprio';
    public const UTILIZADOR_GERIR = 'gerirUtilizadores';
    public const BACKOFFICE_ACEDER = 'acederBackoffice';
}
