<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_home_footer.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial de rodape especifico do layout/home do frontend.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

use yii\helpers\Html;
?>
<!-- Footer -->
<div class="container-fluid bg-light mt-5 py-5">
    <div class="container pt-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Contacto</h5>
                <p class="mb-4">Plataforma de adoção responsável de animais. Ligamos quem quer adotar a quem precisa de um lar.</p>
                <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>Leiria, Portugal</p>
                <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>info@petpanion.pt</p>
                <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+351 244 000 000</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Ligações rápidas</h5>
                <div class="d-flex flex-column justify-content-start">
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Início', ['/site/index'], ['class' => 'text-body mb-2']) ?>
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Adotar', ['/animal/index'], ['class' => 'text-body mb-2']) ?>
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Associações', ['/associacao/index'], ['class' => 'text-body mb-2']) ?>
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Sobre', ['/site/about'], ['class' => 'text-body mb-2']) ?>
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>FAQ', ['/site/faq'], ['class' => 'text-body']) ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">A tua conta</h5>
                <div class="d-flex flex-column justify-content-start">
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Entrar', ['/site/login'], ['class' => 'text-body mb-2']) ?>
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Registar', ['/site/signup'], ['class' => 'text-body mb-2']) ?>
                    <?= Html::a('<i class="bi bi-arrow-right text-primary me-2"></i>Contacto', ['/site/contact'], ['class' => 'text-body']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-white-50 py-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-md-0">&copy; <?= date('Y') ?> Petpanion. Todos os direitos reservados.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Template por <a class="text-white" href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
        </div>
    </div>
</div>
