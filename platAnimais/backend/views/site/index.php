<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Painel Principal</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Bem-vindo ao PlatAnimais</h4>
                        <p>
                            Bem-vindo ao painel de administração da plataforma
                            PlatAnimais.
                        </p>
                        <p>
                            A partir do menu lateral pode gerir os animais,
                            acompanhar os pedidos de adoção e consultar as
                            restantes áreas do sistema.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4>Animais</h4>
                        <p>Gerir animais</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <a href="<?= Url::to(['/animal/index']) ?>"
                       class="small-box-footer">
                        Aceder <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4>Adoções</h4>
                        <p>Consultar pedidos de adoção</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <a href="<?= Url::to(['/adocao/index']) ?>"
                       class="small-box-footer">
                        Aceder <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4>Associações</h4>
                        <p>Consultar associações</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <a href="<?= Url::to(['/associacao/index']) ?>"
                       class="small-box-footer">
                        Aceder <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>