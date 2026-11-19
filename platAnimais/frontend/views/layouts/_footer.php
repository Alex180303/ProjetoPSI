<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_footer.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Partial reutilizavel de rodape incluido nos layouts.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="login-footer">
    <div class="login-footer-inner">
<!--        --><?php
/**
 * Ficheiro de view: platAnimais\frontend\views\layouts\_footer.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Partial reutilizável de rodapé incluído nos layouts.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */ //= Html::a(
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