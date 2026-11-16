<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use frontend\assets\HomeAsset;
use yii\helpers\Html;

HomeAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'image/png',
    'href' => Yii::getAlias('@web/imagens/Logotipo.png'),
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('_home_header') ?>

<?php foreach (Yii::$app->session->getAllFlashes() as $tipo => $mensagem): ?>
    <div class="container mt-3">
        <div class="alert alert-<?= Html::encode($tipo === 'error' ? 'danger' : $tipo) ?>" role="alert">
            <?= Html::encode(is_array($mensagem) ? implode(' ', $mensagem) : $mensagem) ?>
        </div>
    </div>
<?php endforeach; ?>

<?= $content ?>

<?= $this->render('_home_footer') ?>

<a href="#" class="btn btn-primary py-3 fs-4 back-to-top" aria-label="Voltar ao topo"><i class="bi bi-arrow-up"></i></a>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
