<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\sidebar.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial da barra lateral/menu de navegacao do backoffice.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action ? Yii::$app->controller->action->id : '';

$isActive = static function (string $id, string $act = null) use ($controller, $action): string {
    if ($controller !== $id) {
        return '';
    }
    if ($act !== null && $action !== $act) {
        return '';
    }
    return ' active';
};

$username = Yii::$app->user->isGuest ? 'Visitante' : Yii::$app->user->identity->username;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= Url::to(['/site/index']) ?>" class="brand-link">
        <span class="brand-icon" aria-hidden="true">&#128062;</span>
        <span class="brand-text font-weight-light">PlatAnimais</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <span class="user-avatar" aria-hidden="true">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <div class="info">
                <span class="d-block text-white"><?= Html::encode($username) ?></span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="<?= Url::to(['/site/index']) ?>"
                       class="nav-link<?= $isActive('site', 'index') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">GESTÃO</li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/animal/index']) ?>"
                       class="nav-link<?= $isActive('animal') ?>">
                        <i class="nav-icon fas fa-paw"></i>
                        <p>Animais</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/associacao/index']) ?>"
                       class="nav-link<?= $isActive('associacao') ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Associações</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/adocao/index']) ?>"
                       class="nav-link<?= $isActive('adocao') ?>">
                        <i class="nav-icon fas fa-heart"></i>
                        <p>Pedidos de adoção</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/ficha-clinica/index']) ?>"
                       class="nav-link<?= $isActive('ficha-clinica') ?>">
                        <i class="nav-icon fas fa-syringe"></i>
                        <p>Fichas de vacinação</p>
                    </a>
                </li>

                <li class="nav-header">SISTEMA</li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/notificacao/index']) ?>"
                       class="nav-link<?= $isActive('notificacao') ?>">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notificações</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/perfil/index']) ?>"
                       class="nav-link<?= $isActive('perfil') ?>">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Perfil</p>
                    </a>
                </li>

                <li class="nav-header">CATÁLOGO</li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/especie/index']) ?>"
                       class="nav-link<?= $isActive('especie') ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Espécies</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/raca/index']) ?>"
                       class="nav-link<?= $isActive('raca') ?>">
                        <i class="nav-icon fas fa-dog"></i>
                        <p>Raças</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/porte/index']) ?>"
                       class="nav-link<?= $isActive('porte') ?>">
                        <i class="nav-icon fas fa-ruler-horizontal"></i>
                        <p>Portes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/desconto/index']) ?>"
                       class="nav-link<?= $isActive('desconto') ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Descontos</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
