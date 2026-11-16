<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="nav-link">
                <?= Yii::$app->user->isGuest
                        ? 'Visitante'
                        : Html::encode(Yii::$app->user->identity->username) ?>
            </span>
        </li>

        <?php if (!Yii::$app->user->isGuest): ?>
            <li class="nav-item">
                <?= Html::beginForm(['/site/logout'], 'post') ?>
                <?= Html::submitButton(
                        '<i class="fas fa-sign-out-alt"></i> Terminar sessão',
                        ['class' => 'btn btn-link nav-link']
                ) ?>
                <?= Html::endForm() ?>
            </li>
        <?php endif; ?>
    </ul>

</nav>