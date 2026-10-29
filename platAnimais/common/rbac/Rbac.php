<?php

declare(strict_types=1);

namespace common\rbac;

/**
 * Nomes dos papéis e das permissões definidos na Matriz RBAC da plataforma de adoção.
 *
 * Convenção das permissões: verbo primeiro e, depois, o recurso
 * (ex.: CONSULTAR_ANIMAL / consultarAnimal).
 *
 * Usar constantes evita erros ortográficos nos controladores e mantém um único
 * ponto de verdade para os nomes persistidos no authManager.
 */
final class Rbac
{
    // Papéis (roles)
    public const ROLE_VISITANTE = 'visitante';
    public const ROLE_ADOTANTE = 'adotante';
    public const ROLE_ANUNCIANTE = 'anunciante';
    public const ROLE_ADMIN = 'admin';

    // Permissões (permissions) — verbo primeiro, recurso depois
    public const CONSULTAR_ANIMAL = 'consultarAnimal';
    public const CONSULTAR_ASSOCIACAO = 'consultarAssociacao';
    public const REGISTAR_CONTA = 'registarConta';
    public const SUBMETER_ADOCAO = 'submeterAdocao';
    public const CONSULTAR_ADOCOES_PROPRIAS = 'consultarAdocoesProprias';
    public const FAVORITAR_ANIMAL = 'favoritarAnimal';
    public const EDITAR_PERFIL_PROPRIO = 'editarPerfilProprio';
    public const PUBLICAR_ANIMAL = 'publicarAnimal';
    public const GERIR_ANIMAIS_PROPRIOS = 'gerirAnimaisProprios';
    public const GERIR_TODOS_ANIMAIS = 'gerirTodosAnimais';
    public const CONSULTAR_SAUDE = 'consultarSaude';
    public const GERIR_SAUDE_PROPRIOS = 'gerirSaudeProprios';
    public const AVALIAR_CANDIDATURA = 'avaliarCandidatura';
    public const GERIR_UTILIZADORES = 'gerirUtilizadores';
    public const GERIR_CATALOGO = 'gerirCatalogo';
    public const CONFIGURAR_SISTEMA = 'configurarSistema';

    /**
     * Permissões cujo acesso é limitado aos registos do próprio utilizador
     * (ou da associação a que pertence). Ficam associadas à regra isOwner.
     *
     * @return string[]
     */
    public static function ownPermissions(): array
    {
        return [
            self::CONSULTAR_ADOCOES_PROPRIAS,
            self::EDITAR_PERFIL_PROPRIO,
            self::GERIR_ANIMAIS_PROPRIOS,
            self::GERIR_SAUDE_PROPRIOS,
        ];
    }

    /**
     * Papéis e respetivas descrições.
     *
     * @return array<string, string>
     */
    public static function roles(): array
    {
        return [
            self::ROLE_VISITANTE => 'Visitante (utilizador não autenticado)',
            self::ROLE_ADOTANTE => 'Adotante',
            self::ROLE_ANUNCIANTE => 'Anunciante / associação',
            self::ROLE_ADMIN => 'Admin do sistema',
        ];
    }

    /**
     * Permissões e respetivas descrições, tal como constam da matriz.
     *
     * @return array<string, string>
     */
    public static function permissions(): array
    {
        return [
            self::CONSULTAR_ANIMAL => 'Listar, filtrar e ver a ficha de animais',
            self::CONSULTAR_ASSOCIACAO => 'Consultar associações, FAQ e Sobre',
            self::REGISTAR_CONTA => 'Criar conta',
            self::SUBMETER_ADOCAO => 'Submeter pedido de adoção',
            self::CONSULTAR_ADOCOES_PROPRIAS => 'Acompanhar pedidos de adoção próprios',
            self::FAVORITAR_ANIMAL => 'Guardar animais favoritos',
            self::EDITAR_PERFIL_PROPRIO => 'Editar o próprio perfil',
            self::PUBLICAR_ANIMAL => 'Criar anúncio de animal com fotografia',
            self::GERIR_ANIMAIS_PROPRIOS => 'Editar anúncio e estado dos animais próprios',
            self::GERIR_TODOS_ANIMAIS => 'Gerir qualquer anúncio de animal',
            self::CONSULTAR_SAUDE => 'Ver ficha de saúde e histórico clínico',
            self::GERIR_SAUDE_PROPRIOS => 'Gerir registos de saúde dos animais próprios',
            self::AVALIAR_CANDIDATURA => 'Aprovar ou recusar pedidos de adoção recebidos',
            self::GERIR_UTILIZADORES => 'Gerir contas, papéis e bloqueios de utilizadores',
            self::GERIR_CATALOGO => 'Gerir associações, espécies, raças e FAQ',
            self::CONFIGURAR_SISTEMA => 'Configurar a plataforma',
        ];
    }
}
