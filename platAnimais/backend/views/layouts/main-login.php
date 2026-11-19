<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Layout de autenticacao: estrutura simplificada para paginas como login.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);
$this->registerCssFile('@web/css/theme.css');
?>
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout de autenticação: estrutura simplificada para páginas como login.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PlatAnimais | Iniciar sessão</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout de autenticação: estrutura simplificada para páginas como login.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->registerCsrfMetaTags() ?>
    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout de autenticação: estrutura simplificada para páginas como login.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout de autenticação: estrutura simplificada para páginas como login.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */  $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?= Yii::$app->homeUrl ?>"><b>Plat</b>Animais</a>
    </div>
    <!-- /.login-logo -->

    <?= $content ?>
</div>
<!-- /.login-box -->

<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout de autenticação: estrutura simplificada para páginas como login.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endBody() ?>
</body>
</html>
<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\main-login.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Layout de autenticação: estrutura simplificada para páginas como login.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ $this->endPage() ?>