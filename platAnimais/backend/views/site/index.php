<?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\index.php
 *
 * View do controlador Site (paginas gerais, autenticacao e informacao).
 * Pagina inicial da area (home/dashboard): apresenta o conteudo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formularios/widgets) com os dados fornecidos pelo controller.
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */

$this->title = 'Dashboard';

$username = Yii::$app->user->isGuest ? 'Visitante' : Yii::$app->user->identity->username;

$stats = [
    [
        'label' => 'Animais',
        'value' => '128',
        'icon' => 'fas fa-paw',
        'class' => 'bg-info',
        'url' => ['/animal/index'],
    ],
    [
        'label' => 'Pedidos de adoção',
        'value' => '36',
        'icon' => 'fas fa-heart',
        'class' => 'bg-success',
        'url' => ['/adocao/index'],
    ],
    [
        'label' => 'Associações',
        'value' => '12',
        'icon' => 'fas fa-building',
        'class' => 'bg-warning',
        'url' => ['/associacao/index'],
    ],
    [
        'label' => 'Fichas de vacinação',
        'value' => '74',
        'icon' => 'fas fa-syringe',
        'class' => 'bg-danger',
        'url' => ['/ficha-clinica/index'],
    ],
];

$recent = [
    ['animal' => 'Boby', 'adotante' => 'Ana Silva', 'estado' => 'Pendente', 'badge' => 'warning', 'data' => '16/11/2026'],
    ['animal' => 'Mimi', 'adotante' => 'Rui Costa', 'estado' => 'Aprovado', 'badge' => 'success', 'data' => '15/11/2026'],
    ['animal' => 'Thor', 'adotante' => 'Marta Dias', 'estado' => 'Em análise', 'badge' => 'info', 'data' => '14/11/2026'],
    ['animal' => 'Luna', 'adotante' => 'Pedro Nunes', 'estado' => 'Recusado', 'badge' => 'danger', 'data' => '13/11/2026'],
];
?>
<div class="container-fluid">

    <!-- Banner de boas-vindas -->
    <div class="welcome-banner">
        <div>
            <h3 class="mb-1">Olá, <?= Html::encode($username) ?></h3>
            <p class="mb-0">Bem-vindo ao back-office do PlatAnimais. Aqui podes gerir animais, associações e pedidos de adoção.</p>
        </div>
        <i class="fas fa-paw welcome-banner-icon" aria-hidden="true"></i>
    </div>

    <!-- Estatísticas -->
    <div class="row">
        <?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ foreach ($stats as $stat): ?>
            <div class="col-lg-3 col-6">
                <div class="small-box <?= $stat['class'] ?>">
                    <div class="inner">
                        <h3><?= Html::encode($stat['value']) ?></h3>
                        <p><?= Html::encode($stat['label']) ?></p>
                    </div>
                    <div class="icon">
                        <i class="<?= $stat['icon'] ?>"></i>
                    </div>
                    <a href="<?= Url::to($stat['url']) ?>" class="small-box-footer">
                        Ver detalhes <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ endforeach; ?>
    </div>

    <div class="row">

        <!-- Pedidos recentes -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pedidos de adoção recentes</h3>
                    <div class="card-tools">
                        <a href="<?= Url::to(['/adocao/index']) ?>" class="btn btn-tool">
                            Ver todos <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-valign-middle mb-0">
                        <thead>
                            <tr>
                                <th>Animal</th>
                                <th>Adotante</th>
                                <th>Estado</th>
                                <th class="text-right">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ foreach ($recent as $row): ?>
                                <tr>
                                    <td><?= Html::encode($row['animal']) ?></td>
                                    <td><?= Html::encode($row['adotante']) ?></td>
                                    <td><span class="badge badge-<?= $row['badge'] ?>"><?= Html::encode($row['estado']) ?></span></td>
                                    <td class="text-right text-muted"><?= Html::encode($row['data']) ?></td>
                                </tr>
                            <?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Progresso -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Estado do sistema</h3>
                </div>
                <div class="card-body">

                    <p class="mb-1">Pedidos analisados</p>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-success" style="width: 72%"></div>
                    </div>

                    <p class="mb-1">Fichas de vacinação completas</p>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-info" style="width: 58%"></div>
                    </div>

                    <p class="mb-1">Animais com associação atribuída</p>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-warning" style="width: 41%"></div>
                    </div>

                    <p class="mb-1">Utilizadores ativos</p>
                    <div class="progress progress-sm mb-0">
                        <div class="progress-bar bg-danger" style="width: 85%"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
