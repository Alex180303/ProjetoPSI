<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= Url::to(['/site/index']) ?>" class="brand-link">
        <span class="brand-text font-weight-light">PlatAnimais</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <li class="nav-item">
                    <a href="<?= Url::to(['/site/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Painel Principal</p>
                    </a>
                </li>

                <li class="nav-header">GESTÃO</li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/animal/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-paw"></i>
                        <p>Animais</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/adocao/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-heart"></i>
                        <p>Pedidos de adoção</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/associacao/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Associações</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/especie/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Espécies</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to(['/raca/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-dog"></i>
                        <p>Raças</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>