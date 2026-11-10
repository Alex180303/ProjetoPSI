<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="login-footer">
    <div class="login-footer-inner">
        <a class="login-logo" href="<?= Url::home() ?>" aria-label="Página inicial">
            <span class="login-logo-mark" aria-hidden="true">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="none">
                    <circle cx="7" cy="7" r="2.2" fill="#7a4a0a"/>
                    <circle cx="12" cy="5.5" r="2.2" fill="#7a4a0a"/>
                    <circle cx="17" cy="7" r="2.2" fill="#7a4a0a"/>
                    <path d="M12 11c-3 0-5.5 2.2-5.5 5 0 2 1.6 3.5 3.6 3.5h3.8c2 0 3.6-1.5 3.6-3.5 0-2.8-2.5-5-5.5-5Z" fill="#7a4a0a"/>
                </svg>
            </span>
            <span>Logo</span>
        </a>

        <nav class="login-footer-links" aria-label="Ligações do rodapé">
            <?= Html::a('Contacto', ['site/contact'], ['class' => 'login-footer-link']) ?>
            <a class="login-footer-link" href="#">Privacidade</a>
            <a class="login-footer-link" href="#">Termos &amp; Condições</a>
        </nav>
    </div>
</footer>