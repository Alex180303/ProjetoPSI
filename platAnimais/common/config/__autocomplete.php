<?php

/**
 * Esta classe existe apenas para autocompletar em IDEs (PHPStorm/Netbeans/...).
 * Este ficheiro nunca e incluido em lado nenhum.
 * Ajuste este ficheiro para corresponder as classes configuradas na configuracao da aplicacao, de forma a ativar
 * o autocompletar do IDE para componentes personalizados.
 * Exemplo: pode adicionar um phpdoc de propriedade na classe `__Application` como
 * `@property \vendor\package\Rollbar|__Rollbar $rollbar` e adicionar uma classe neste ficheiro:
 * ```php
 * // a propriedade @property de \vendor\package\Rollbar fica aqui
 * class __Rollbar {
 * }
 * ```
 */
class Yii
{
    /**
     * @var \yii\web\Application|\yii\console\Application|__Application
     */
    public static $app;
}

/**
 * @property yii\rbac\DbManager $authManager
 * @property \yii\web\User|__WebUser $user
 */
class __Application
{
}

/**
 * @property app\models\User $identity
 */
class __WebUser
{
}
