# RBAC da plataforma de adoção

Implementação da Matriz de permissões RBAC seguindo o capítulo
[Security – Authorization](https://www.yiiframework.com/doc/guide/2.0/en/security-authorization)
do guia do Yii 2, com `yii\rbac\DbManager`.

Convenção das permissões: **verbo primeiro, recurso depois** — por exemplo,
`CONSULTAR_ANIMAL` na constante PHP e `consultarAnimal` como ID persistido no
`authManager`.

## Estrutura criada

| Ficheiro | Função |
| --- | --- |
| `common/rbac/Rbac.php` | Constantes com os nomes dos papéis e permissões. |
| `common/rbac/GuestRule.php` | Regra `isGuest`, que aplica o papel `visitante` apenas a quem não está autenticado. |
| `common/rbac/OwnRecordRule.php` | Regra `isOwner`, usada pelas permissões "próprios". |
| `common/rbac/RbacInitializer.php` | Constrói/atualiza a árvore RBAC a partir do código. |
| `console/controllers/RbacController.php` | Comandos `rbac/init`, `rbac/reset`, `rbac/assign`, `rbac/revoke`, `rbac/show`. |
| `console/migrations/m261029_194206_init_rbac.php` | Aplica a matriz em instalações novas (`yii migrate`). |
| `console/migrations/m261029_210000_rename_rbac_permissions_verb_first.php` | Migra os nomes antigos para a convenção verbo-primeiro. |

A configuração do `authManager` está em `common/config/main.php`. O papel
`visitante` é um **default role**: não é atribuído a utilizadores, sendo
aplicado implicitamente a pedidos não autenticados pela regra `isGuest`.
Assim, `Yii::$app->user->can()` também funciona para visitantes.

## Matriz implementada

| Permissão (ID RBAC) | Constante PHP | Visitante | Adotante | Anunciante / associação | Admin |
| --- | --- | :---: | :---: | :---: | :---: |
| `consultarAnimal` | `CONSULTAR_ANIMAL` | X | X | X | X |
| `consultarAssociacao` | `CONSULTAR_ASSOCIACAO` | X | X | X | X |
| `registarConta` | `REGISTAR_CONTA` | X | | | |
| `submeterAdocao` | `SUBMETER_ADOCAO` | | X | | |
| `consultarAdocoesProprias` | `CONSULTAR_ADOCOES_PROPRIAS` | | X | | |
| `favoritarAnimal` | `FAVORITAR_ANIMAL` | | X | | |
| `editarPerfilProprio` | `EDITAR_PERFIL_PROPRIO` | | X | X | X |
| `publicarAnimal` | `PUBLICAR_ANIMAL` | | | X | X |
| `gerirAnimaisProprios` | `GERIR_ANIMAIS_PROPRIOS` | | | X | X |
| `gerirTodosAnimais` | `GERIR_TODOS_ANIMAIS` | | | | X |
| `consultarSaude` | `CONSULTAR_SAUDE` | X | X | X | X |
| `gerirSaudeProprios` | `GERIR_SAUDE_PROPRIOS` | | | X | X |
| `avaliarCandidatura` | `AVALIAR_CANDIDATURA` | | | X | X |
| `gerirUtilizadores` | `GERIR_UTILIZADORES` | | | | X |
| `gerirCatalogo` | `GERIR_CATALOGO` | | | | X |
| `configurarSistema` | `CONFIGURAR_SISTEMA` | | | | X |

O papel `admin` é filho de `anunciante`, herdando as respetivas permissões.
As permissões exclusivas de `adotante` não são herdadas pelo `admin`, tal como
na matriz.

## Correspondência com os IDs originais da matriz

| ID original | ID implementado |
| --- | --- |
| `animal/consultar` | `consultarAnimal` |
| `associacao/consultar` | `consultarAssociacao` |
| `conta/registar` | `registarConta` |
| `adocao/submeter` | `submeterAdocao` |
| `adocao/consultarProprios` | `consultarAdocoesProprias` |
| `animal/favoritar` | `favoritarAnimal` |
| `perfil/editarProprio` | `editarPerfilProprio` |
| `animal/publicar` | `publicarAnimal` |
| `animal/gerirProprios` | `gerirAnimaisProprios` |
| `animal/gerirTodos` | `gerirTodosAnimais` |
| `saude/consultar` | `consultarSaude` |
| `saude/gerirProprios` | `gerirSaudeProprios` |
| `candidatura/avaliar` | `avaliarCandidatura` |
| `utilizador/gerir` | `gerirUtilizadores` |
| `catalogo/gerir` | `gerirCatalogo` |
| `sistema/configurar` | `configurarSistema` |

## Comandos

```bash
# Criar/atualizar papéis, permissões, regras e hierarquia (preserva atribuições)
php yii rbac/init

# Apagar tudo e reconstruir (remove atribuições de papéis)
php yii rbac/reset

# Atribuir/remover um papel a um utilizador existente
php yii rbac/assign <username> admin
php yii rbac/assign <username> anunciante
php yii rbac/revoke <username> anunciante

# Ver a matriz carregada e as atribuições existentes
php yii rbac/show
```

> **Primeiro administrador:** depois de existir uma conta, execute
> `php yii rbac/assign <username> admin`. Sem esse passo ninguém consegue
> entrar na área de administração (`configurarSistema`).

## Utilização nos controladores

### Access Control Filter

```php
use common\rbac\Rbac;
use yii\filters\AccessControl;

public function behaviors(): array
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => [Rbac::PUBLICAR_ANIMAL],
                ],
            ],
        ],
    ];
}
```

Isto já está aplicado em:

- `backend/controllers/SiteController` — dashboard exige `configurarSistema`;
- `backend/controllers/EspecieController` e `RacaController` — exigem `gerirCatalogo`;
- `frontend/controllers/SiteController` — `signup` exige `registarConta` e
  `about` exige `consultarAssociacao`.

### Verificação direta

```php
if (Yii::$app->user->can(Rbac::SUBMETER_ADOCAO)) {
    // ...
}
```

### Permissões "próprios"

As permissões `consultarAdocoesProprias`, `editarPerfilProprio`,
`gerirAnimaisProprios` e `gerirSaudeProprios` têm a regra `isOwner`.
É obrigatório passar o proprietário do registo:

```php
// Dono direto (ex.: user_id do anúncio)
if (Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, ['ownerId' => $animal->user_id])) {
    // ...
}

// A partir do modelo e de um atributo de propriedade
if (Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, [
    'model' => $animal,
    'ownerAttribute' => 'anunciante_id',
])) {
    // ...
}

// Utilizador ou associação a que pertence
if (Yii::$app->user->can(Rbac::GERIR_ANIMAIS_PROPRIOS, [
    'ownerIds' => [$user->id, $associacao->id],
])) {
    // ...
}
```

Num filtro de acesso, usar `roleParams`:

```php
[
    'allow' => true,
    'actions' => ['update'],
    'roles' => [Rbac::GERIR_ANIMAIS_PROPRIOS],
    'roleParams' => fn() => ['model' => Animal::findOne(Yii::$app->request->get('id'))],
],
```

A regra complementa `Yii::$app->user->can()` com a validação de negócio do
proprietário; ambas as verificações devem ser feitas.

## Notas

- As permissões são verificadas pelo ID (`consultarAnimal`, etc.), pelo que os
  controladores/ações futuros devem usar as constantes de `common\rbac\Rbac`.
- Os utilizadores criados pelo formulário de registo recebem automaticamente o
  papel `adotante` (`frontend/models/SignupForm.php`). Um administrador pode
  depois promover a conta a `anunciante`.
- Em instalações novas, as tabelas do RBAC são criadas primeiro com
  `php yii migrate --migrationPath=@yii/rbac/migrations` e só depois
  `php yii migrate`.
