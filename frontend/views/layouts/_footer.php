<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="login-footer">
    <div class="login-footer-inner">
<!--        --><?php //= Html::a(
//                Html::img(Yii::getAlias('@web/imagens/Logotipo.png'),
//                ['alt' => '',
//                'class' => 'login-logo-image',
//                ]) . Html::tag('span', 'Petpanion', ['class' => 'login-logo-text']),
//                Url::home(),
//                [
//                        'class' => 'login-logo',
//                        'aria-label' => 'Página inicial',
//
//],
//        ) ?>

        <nav class="login-footer-links" aria-label="Ligações do rodapé">
            <?= Html::a('Contacto', ['site/contact'], ['class' => 'login-footer-link']) ?>
            <a class="login-footer-link" href="#">Privacidade</a>
            <a class="login-footer-link" href="#">Termos &amp; Condições</a>
        </nav>
    </div>
</footer>