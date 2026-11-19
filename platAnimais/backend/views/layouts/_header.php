<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\_header.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial do cabecalho/topo da pagina.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

$items = [
    [
        'label' => 'Home',
        'url' => ['/site/index'],
    ],
    [
        'label' => 'Login',
        'url' => ['/site/login'],
        'visible' => Yii::$app->user->isGuest,
    ],
    [
        'label' => 'Logout (' . Html::encode(Yii::$app->user->identity?->username) . ')',
        'url' => ['/site/logout'],
        'linkOptions' => [
            'data-method' => 'post',
            'class' => 'logout',
        ],
        'visible' => !Yii::$app->user->isGuest,
    ],
];
?>
<header id="header">
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial do cabeçalho/topo da página.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ NavBar::begin(
        [
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ],
    ) ?>
    <?= Nav::widget(
        [
            'options' => ['class' => 'navbar-nav me-auto'],
            'encodeLabels' => false,
            'items' => $items,
        ],
    ) ?>
    <?= Html::button(
        '&#127769;',
        [
            'id' => 'theme-toggle',
            'class' => 'btn btn-link nav-link fs-5',
            'aria-label' => 'Switch to dark mode',
        ],
    ) ?>
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial do cabeçalho/topo da página.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ NavBar::end() ?>
</header>
