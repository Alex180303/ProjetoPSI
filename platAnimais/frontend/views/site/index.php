<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (paginas gerais, autenticacao e informacao).
 * Pagina inicial da area (home/dashboard): apresenta o conteudo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formularios/widgets) com os dados fornecidos pelo controller.
 */

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Petpanion – Adoção responsável de animais';
$img = static fn (string $f): string => Yii::getAlias('@web/template/img/' . $f);
?>

<!-- Hero -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <h1 class="display-1 text-uppercase text-dark mb-lg-4">Petpanion</h1>
                <h1 class="text-uppercase text-white mb-lg-4">Dá um lar a quem precisa</h1>
                <p class="fs-4 text-white mb-lg-4">Encontra o teu novo melhor amigo, conhece as associações e acompanha todo o processo de adoção num só sítio.</p>
                <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                    <?= Html::a('Quero adotar', ['/animal/index'], ['class' => 'btn btn-outline-light border-2 py-md-3 px-md-5 me-3']) ?>
                    <?= Html::a('Saber mais', ['/site/about'], ['class' => 'btn btn-light py-md-3 px-md-5']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sobre -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded" src="<?= $img('about.jpg') ?>" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="border-start border-5 border-primary ps-5 mb-5">
                    <h6 class="text-primary text-uppercase">Sobre nós</h6>
                    <h1 class="display-5 text-uppercase mb-0">Adoção responsável, do primeiro contacto ao novo lar</h1>
                </div>
                <h4 class="text-body mb-4">A Petpanion liga adotantes, anunciantes e associações de proteção animal numa plataforma simples e transparente.</h4>
                <div class="bg-light p-4">
                    <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1" aria-selected="true">Missão</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">Visão</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            <p class="mb-0">Facilitar a adoção de animais abandonados, dando visibilidade às associações e acompanhando cada candidatura com informação clara sobre a saúde e o historial do animal.</p>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            <p class="mb-0">Ser a referência em Portugal na adoção responsável, onde cada animal encontra uma família e cada família encontra o companheiro certo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Como funciona -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Como funciona</h6>
            <h1 class="display-5 text-uppercase mb-0">Tudo o que precisas para adotar</h1>
        </div>
        <div class="row g-5">
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */
            $passos = [
                    ['flaticon-dog', 'Procura animais', 'Filtra por espécie, raça e porte e vê a ficha completa de cada animal.'],
                    ['flaticon-house', 'Candidata-te', 'Submete o teu pedido de adoção e acompanha o estado da candidatura.'],
                    ['flaticon-vaccine', 'Ficha clínica', 'Consulta vacinas e historial de saúde antes de decidir.'],
                    ['flaticon-cat', 'Anuncia um animal', 'Publica um anúncio com fotografia e gere os pedidos que receberes.'],
                    ['bi bi-building', 'Associações', 'Conhece as associações parceiras e os animais que têm para adoção.'],
                    ['bi bi-heart', 'Favoritos', 'Guarda os animais de que mais gostaste e volta a eles quando quiseres.'],
            ];
            foreach ($passos as [$icone, $titulo, $texto]): ?>
                <div class="col-md-6">
                    <div class="service-item bg-light d-flex p-4">
                        <i class="<?= $icone ?> display-1 text-primary me-4"></i>
                        <div>
                            <h5 class="text-uppercase mb-3"><?= Html::encode($titulo) ?></h5>
                            <p class="mb-0"><?= Html::encode($texto) ?></p>
                        </div>
                    </div>
                </div>
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ endforeach; ?>
        </div>
    </div>
</div>

<!-- Procurar por espécie -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Procurar</h6>
            <h1 class="display-5 text-uppercase mb-0">Qual é o teu melhor amigo?</h1>
        </div>
        <div class="row g-4">
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ foreach ([['flaticon-dog', 'Cães'], ['flaticon-cat', 'Gatos'], ['bi bi-egg', 'Coelhos'], ['bi bi-feather', 'Outros']] as [$icone, $nome]): ?>
                <div class="col-6 col-lg-3">
                    <?= Html::a(
                            '<i class="' . $icone . ' display-1 text-primary mb-3 d-block"></i><h5 class="text-uppercase mb-0">' . Html::encode($nome) . '</h5>',
                            ['/animal/index'],
                            ['class' => 'd-block bg-light text-center text-dark p-5'],
                    ) ?>
                </div>
            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ endforeach; ?>
        </div>
    </div>
</div>

<!-- Chamada à ação -->
<div class="container-fluid bg-offer my-5 py-5">
    <div class="container py-5">
        <div class="row gx-5 justify-content-start">
            <div class="col-lg-7">
                <div class="border-start border-5 border-dark ps-5 mb-5">
                    <h6 class="text-dark text-uppercase">Junta-te a nós</h6>
                    <h1 class="display-5 text-uppercase text-white mb-0">Cria a tua conta e começa a adotar</h1>
                </div>
                <p class="text-white mb-4">O registo é gratuito. Depois de criares conta podes candidatar-te, guardar favoritos e acompanhar os teus pedidos.</p>
                <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ if (Yii::$app->user->isGuest): ?>
                    <?= Html::a('Registar', ['/site/signup'], ['class' => 'btn btn-light py-md-3 px-md-5 me-3']) ?>
                    <?= Html::a('Entrar', ['/site/login'], ['class' => 'btn btn-outline-light py-md-3 px-md-5']) ?>
                <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ else: ?>
                    <?= Html::a('Ver animais', ['/animal/index'], ['class' => 'btn btn-light py-md-3 px-md-5']) ?>
                <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\index.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página inicial da área (home/dashboard): apresenta o conteúdo de entrada ao utilizador.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ endif; ?>
            </div>
        </div>
    </div>
</div>
