<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_home_header.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial de cabecalho especifico do layout/home do frontend.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user;
?>
<!-- Topbar -->
<div class="container-fluid border-bottom d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-4 text-center py-2">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Localização</h6>
                    <span>Leiria, Portugal</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center border-start border-end py-2">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Email</h6>
                    <span>info@petpanion.pt</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center py-2">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Telefone</h6>
                    <span>+351 244 000 000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="<?= Url::home() ?>" class="navbar-brand ms-lg-5">
        <h1 class="m-0 text-uppercase text-dark">
            <?= Html::img(Yii::getAlias('@web/imagens/Logotipo.png'), ['alt' => '', 'style' => 'height:40px;width:auto;', 'class' => 'me-2']) ?>Petpanion
        </h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Abrir menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <?= Html::a('Início', ['#'], ['class' => 'nav-item nav-link active']) ?>
            <?= Html::a('Procurar', ['#'], ['class' => 'nav-item nav-link']) ?>
            <?= Html::a('Adotar', ['#'], ['class' => 'nav-item nav-link']) ?>
            <?= Html::a('Anunciar', ['#'], ['class' => 'nav-item nav-link']) ?>
            <?= Html::a('Associações', ['#'], ['class' => 'nav-item nav-link']) ?>
            <?= Html::a('Sobre', ['#'], ['class' => 'nav-item nav-link']) ?>
            <?= Html::a('FAQ', ['#'], ['class' => 'nav-item nav-link']) ?>

            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_home_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial de cabeçalho específico do layout/home do frontend.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ if ($user->isGuest): ?>
                <?= Html::a('Entrar', ['/site/login'], ['class' => 'nav-item nav-link']) ?>
                <?= Html::a('Registar <i class="bi bi-arrow-right"></i>', ['/site/signup'], [
                    'class' => 'nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-3',
                ]) ?>
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_home_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial de cabeçalho específico do layout/home do frontend.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ else: ?>
                <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex']) ?>
                <?= Html::submitButton('Sair (' . Html::encode($user->identity->username) . ')', [
                    'class' => 'nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-3 border-0',
                ]) ?>
                <?= Html::endForm() ?>
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_home_header.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial de cabeçalho específico do layout/home do frontend.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ endif; ?>
        </div>
    </div>
</nav>
