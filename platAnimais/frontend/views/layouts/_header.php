<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_header.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial do cabecalho/topo da pagina.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user;
?>

<header class="login-header">
    <div class="login-header-inner">
        <?= Html::a(
                Html::img(Yii::getAlias('@web/imagens/Logotipo.png'), [
                        'alt' => '',
                        'class' => 'login-logo-image',
//                        'style' => 'height: 32px !important; width: auto !important;',
                ]) . Html::tag('span', 'Petpanion', ['class' => 'login-logo-text']),
                Url::home(),
                [
                        'class' => 'login-logo',
                        'aria-label' => 'Página inicial',
                ],
        ) ?>

        <nav class="login-header-actions" aria-label="Ações da conta">
            <?= Html::a('Procurar', ['/site/index'], ['class' => 'login-action']) ?>

            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial do cabeçalho/topo da página.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ if ($user->isGuest): ?>
                <?= Html::a('Entrar', ['/site/login'], ['class' => 'login-action']) ?>
                <?= Html::a('Registar', ['/site/signup'], [
                        'class' => 'login-action login-action-accent',
                ]) ?>
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial do cabeçalho/topo da página.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ else: ?>
                <?= Html::beginForm(['/site/logout'], 'post', [
                        'class' => 'login-logout-form',
                ]) ?>
                <?= Html::submitButton('Sair', [
                        'class' => 'login-action login-logout-button',
                ]) ?>
                <?= Html::endForm() ?>
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial do cabeçalho/topo da página.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ endif; ?>
        </nav>
    </div>

    <nav class="login-main-nav" aria-label="Navegação principal">
        <?= Html::a('Procurar', ['/animal/index'], ['class' => 'login-action']) ?>
        <?= Html::a('Adotar', ['/animal/index'], ['class' => 'login-nav-link']) ?>
        <?= Html::a('Anunciar', ['/site/anunciar-animal'], ['class' => 'login-nav-link']) ?>
        <?= Html::a('Associações', ['/associacao/index'], ['class' => 'login-nav-link']) ?>
        <?= Html::a('Sobre', ['/site/about'], ['class' => 'login-nav-link']) ?>
        <?= Html::a('FAQ', ['/site/faq'], ['class' => 'login-nav-link']) ?>
    </nav>
</header>