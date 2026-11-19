<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_head.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial do <head>: metadados, titulo e registo de assets/estilos.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

/** @var yii\web\View $this */

use frontend\assets\AppAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(
    ['charset' => Yii::$app->charset],
    'charset',
);
$this->registerMetaTag(
    [
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1',
    ],
);
if (!empty($this->params['meta_description'])) {
    $this->registerMetaTag(
        [
            'name' => 'description',
            'content' => $this->params['meta_description'],
        ],
    );
}
if (!empty($this->params['meta_keywords'])) {
    $this->registerMetaTag(
        [
            'name' => 'keywords',
            'content' => $this->params['meta_keywords'],
        ],
    );
}
$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'image/png',
    'href' => Yii::getAlias('@web/imagens/Logotipo.png'),
]);

