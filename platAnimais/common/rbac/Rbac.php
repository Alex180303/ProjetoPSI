<?php

declare(strict_types=1);

namespace common\rbac;

/**
 * Nomes dos papéis e permissões do RBAC.
 * Os valores têm de coincidir com os nomes criados na migração de RBAC
 * (ex.: m170124_084304_init_rbac) e com o que está na tabela auth_item.
 */
class Rbac
{
    // Papéis
    public const ROLE_VISITANTE = 'visitante';
    public const ROLE_ADOTANTE = 'adotante';

    // Permissões (nomes reais da tabela auth_item, formato verbo-primeiro)
    public const REGISTAR_CONTA = 'registarConta';
    public const CONSULTAR_ASSOCIACAO = 'consultarAssociacao';
    public const GERIR_CATALOGO = 'gerirCatalogo';
    public const CONFIGURAR_SISTEMA = 'configurarSistema';
    public const ANIMAL_CONSULTAR = 'consultarAnimal';
    public const ANIMAL_PUBLICAR = 'publicarAnimal';
    public const ANIMAL_GERIR_PROPRIOS = 'gerirAnimaisProprios';
    public const ANIMAL_GERIR_TODOS = 'gerirTodosAnimais';
    public const ADOCAO_SUBMETER = 'submeterAdocao';
    public const ADOCAO_CONSULTAR_PROPRIOS = 'consultarAdocoesProprias';
    public const CANDIDATURA_AVALIAR = 'avaliarCandidatura';
    public const SAUDE_CONSULTAR = 'consultarSaude';
    public const SAUDE_GERIR_PROPRIOS = 'gerirSaudeProprios';
    public const UTILIZADOR_GERIR = 'gerirUtilizadores';
}
