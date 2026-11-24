<?php

declare(strict_types=1);

namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Asset bundle para alternar o modo de cor.
 *
 * Disponibiliza o script de alternancia de tema claro/escuro (Bootstrap 5.3+) partilhado pelo frontend e backend.
 */
class ColorModeAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/colormode';
    public $js = [
        'js/color-mode.js',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}
