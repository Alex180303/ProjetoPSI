<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\navbar.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial da barra de navegacao superior.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */

$username = Yii::$app->user->isGuest ? 'Visitante' : Yii::$app->user->identity->username;
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Menu lateral -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Alternar menu">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">Início</a>
        </li>
    </ul>

    <!-- Pesquisa -->
    <form class="form-inline ml-3 d-none d-md-block" action="#" method="get">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search"
                   placeholder="Pesquisar..." aria-label="Pesquisar">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit" aria-label="Procurar">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Notificações e utilizador -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-label="Notificações">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">3 notificações</span>
                <div class="dropdown-divider"></div>
                <a href="<?= Url::to(['/adocao/index']) ?>" class="dropdown-item">
                    <i class="fas fa-heart mr-2 text-danger"></i> Novo pedido de adoção
                    <span class="float-right text-muted text-sm">há 5 min</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= Url::to(['/ficha-clinica/index']) ?>" class="dropdown-item">
                    <i class="fas fa-syringe mr-2 text-success"></i> Ficha de vacinação atualizada
                    <span class="float-right text-muted text-sm">há 1 h</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= Url::to(['/notificacao/index']) ?>" class="dropdown-item dropdown-footer">
                    Ver todas as notificações
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user mr-1"></i>
                <span class="d-none d-md-inline"><?= Html::encode($username) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= Url::to(['/perfil/index']) ?>" class="dropdown-item">
                    <i class="fas fa-user-circle mr-2"></i> Perfil
                </a>
                <a href="<?= Url::to(['/notificacao/index']) ?>" class="dropdown-item">
                    <i class="fas fa-bell mr-2"></i> Notificações
                </a>
                <div class="dropdown-divider"></div>
                <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\navbar.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial da barra de navegação superior.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ if (!Yii::$app->user->isGuest): ?>
                    <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'm-0']) ?>
                    <?= Html::submitButton(
                        '<i class="fas fa-sign-out-alt mr-2"></i> Terminar sessão',
                        ['class' => 'btn btn-link dropdown-item'],
                    ) ?>
                    <?= Html::endForm() ?>
                <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\navbar.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial da barra de navegação superior.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ else: ?>
                    <a href="<?= Url::to(['/site/login']) ?>" class="dropdown-item">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar sessão
                    </a>
                <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\navbar.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial da barra de navegação superior.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ endif; ?>
            </div>
        </li>

    </ul>

</nav>
