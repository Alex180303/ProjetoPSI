<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Layout minimo/limpo sem estrutura completa de navegacao.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout mínimo/limpo sem estrutura completa de navegação.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" data-bs-theme="light">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout mínimo/limpo sem estrutura completa de navegação.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout mínimo/limpo sem estrutura completa de navegação.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->head() ?>
</head>
<body class="d-flex flex-column justify-content-center align-items-center vh-100">
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout mínimo/limpo sem estrutura completa de navegação.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginBody() ?>

<?= $content ?>

<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout mínimo/limpo sem estrutura completa de navegação.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endBody() ?>
</body>
</html>
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\blank.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout mínimo/limpo sem estrutura completa de navegação.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endPage();
