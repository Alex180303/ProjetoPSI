<?php

declare(strict_types=1);

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Assets do template "Pet Shop" (HTML Codex), usados só na página inicial.
 *
 * Não depende de BootstrapAsset de propósito: o template traz o seu próprio
 * Bootstrap 5 personalizado, que entraria em conflito com o do Yii e
 * alteraria o aspeto do login e do registo (que continuam a usar AppAsset).
 */
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
        'template/lib/flaticon/font/flaticon.css',
        'template/lib/owlcarousel/assets/owl.carousel.min.css',
        'template/css/bootstrap.min.css',
        'template/css/style.css',
    ];

    public $js = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js',
        'template/lib/easing/easing.min.js',
        'template/lib/waypoints/waypoints.min.js',
        'template/lib/owlcarousel/owl.carousel.min.js',
        'template/js/main.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}
