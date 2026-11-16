<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace frontend\assets;

use common\assets\ColorModeAsset;
use yii\bootstrap5\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/auth.css',
        // CSS do template
        'template/lib/animate/animate.min.css',
        'template/lib/owlcarousel/assets/owl.carousel.min.css',
        'template/css/style.css',
    ];
    public $js = [
        'template/lib/wow/wow.min.js',
        'template/lib/owlcarousel/owl.carousel.min.js',
        'template/js/main.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        ColorModeAsset::class,
    ];
}
