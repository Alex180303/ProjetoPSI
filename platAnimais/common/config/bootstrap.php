<?php

declare(strict_types=1);

/**
 * Bootstrap de aliases comuns do Yii2.
 *
 * Define atalhos (@common, @frontend, @backend, @console) para os diretórios principais da aplicação,
 * permitindo referenciar paths de forma consistente em configs, views, controllers e autoloading.
 */
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
