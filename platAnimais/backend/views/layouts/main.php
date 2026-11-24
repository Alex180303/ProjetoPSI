<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Layout principal: envolve o conteudo das views ($content) e inclui header/navbar/sidebar/footer conforme a area.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');
$this->registerCssFile('@web/css/theme.css');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contem o conteudo da pagina -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endBody() ?>
</body>
</html>
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout principal: envolve o conteúdo das views (\) e inclui header/navbar/sidebar/footer conforme a área.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endPage() ?>
