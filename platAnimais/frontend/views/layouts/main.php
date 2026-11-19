<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Layout principal: envolve o conteudo das views ($content) e inclui header/navbar/sidebar/footer conforme a area.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

$this->render('_head');
?>
<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" data-bs-theme="light">
<head>
    <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body class="auth-body d-flex flex-column h-100">
<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginBody() ?>

<?= $this->render('_header') ?>

<main id="main" class="flex-grow-1" role="main">
    <div class="container">
        <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?= $this->render('_footer') ?>

<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endBody() ?>
</body>
</html>
<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endPage() ?>
