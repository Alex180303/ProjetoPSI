<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Entrar';
$this->params['meta_description'] = 'Entrar na plataforma de adoção de animais.';
$this->params['meta_keywords'] = 'entrar, login, adoção, animais, associações';

$this->registerCss(<<<'CSS'
html,
body {
    background: #101319;
}

#header,
#footer {
    display: none;
}

main {
    background: #101319;
}

main > .container {
    display: block;
    max-width: none;
    min-height: 100%;
    padding: 0;
}

main > .container > .alert {
    max-width: 400px;
    margin: 1rem auto 0;
}

.login-page {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: #101319;
    color: #c5cee0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

.login-header {
    padding: 1.375rem 4.5rem 0 3rem;
}

.login-header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.login-logo {
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
    color: #9db8ff;
    font-size: 1.25rem;
    font-weight: 600;
    letter-spacing: 0.01em;
    line-height: 1;
    text-decoration: none;
}

.login-logo:hover {
    color: #b9ccff;
}

.login-logo-mark {
    display: inline-flex;
    flex: 0 0 auto;
}

.login-header .login-logo {
    position: relative;
    top: -1px;
}

.login-header-actions {
    display: flex;
    align-items: center;
    gap: 2.75rem;
}

.login-action {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    color: #c5cee0;
    font-size: 1rem;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
}

.login-action:hover {
    color: #9db8ff;
}

.login-action-accent {
    color: #9db8ff;
}

.login-action-accent:hover {
    color: #b9ccff;
}

.login-header-actions .login-action-accent {
    margin-left: 0.4375rem;
}

.login-main-nav {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 2.75rem;
    margin-top: 2.5rem;
    margin-right: -4.5rem;
    margin-left: -3rem;
    padding-bottom: 0.75rem;
}

.login-nav-link {
    color: #c5cee0;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    white-space: nowrap;
}

.login-nav-link:hover {
    color: #9db8ff;
}

.login-content {
    display: flex;
    flex: 1;
    align-items: center;
    justify-content: center;
    padding: 4.5rem 1.5rem 4rem;
}

.login-form-wrap {
    width: 100%;
    max-width: 400px;
}

.login-title {
    margin: -0.5rem 0 1.55rem;
    color: #9db8ff;
    font-size: 2.1875rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    line-height: 1.15;
    text-align: center;
}

.login-form .login-field {
    margin-bottom: 1.5rem;
}

.login-form .login-label {
    position: relative;
    top: -4px;
    display: block;
    margin-bottom: 0.2rem;
    color: #98a2b8;
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.2;
}

.login-form .login-input {
    display: block;
    width: 100%;
    height: 46px;
    padding: 0 1rem;
    border: 0;
    border-radius: 8px;
    background: #151a24;
    color: #e6eaf2;
    font-family: inherit;
    font-size: 0.95rem;
    line-height: 46px;
    box-shadow: none;
}

.login-form .login-input:focus {
    background: #151a24;
    color: #e6eaf2;
    outline: 2px solid rgba(157, 184, 255, 0.55);
    outline-offset: 0;
    box-shadow: none;
}

.login-form .login-input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #151a24 inset;
    -webkit-text-fill-color: #e6eaf2;
}

.login-form .login-input.is-invalid {
    outline: 1px solid #fca5a5;
}

.login-form .login-error {
    display: block;
    margin-top: 0.4rem;
    color: #fca5a5;
    font-size: 0.8rem;
    line-height: 1.3;
}

.login-form .login-error:empty {
    display: none;
}

.login-forgot {
    margin-top: 1.5rem;
    text-align: right;
}

.login-forgot-link {
    position: relative;
    top: -4px;
    color: #f0b060;
    font-size: 1rem;
    text-decoration: none;
}

.login-forgot-link:hover {
    color: #ffd9a8;
    text-decoration: underline;
}

.login-submit {
    display: block;
    width: 100%;
    height: 47px;
    margin-top: 0.7rem;
    border: 0;
    border-radius: 8px;
    background: #7a4a0a;
    color: #ffd9a8;
    font-family: inherit;
    font-size: 1rem;
    font-weight: 600;
    line-height: 47px;
    cursor: pointer;
    transition: background-color 0.15s ease;
}

.login-submit:hover,
.login-submit:focus {
    background: #8a5510;
    color: #ffd9a8;
}

.login-submit:focus-visible {
    outline: 2px solid #f0b060;
    outline-offset: 2px;
}

.login-signup {
    position: relative;
    top: -3px;
    margin: 1.5rem 0 0;
    color: #98a2b8;
    font-size: 1rem;
    line-height: 1.2;
    text-align: center;
}

.login-signup-link {
    color: #f0b060;
    text-decoration: none;
}

.login-signup-link:hover {
    color: #ffd9a8;
    text-decoration: underline;
}

.login-footer {
    padding: 1.875rem 3.75rem 1.625rem 3rem;
}

.login-footer-inner {
    position: relative;
    top: -2px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.login-footer .login-logo {
    font-size: 1.1rem;
}

.login-footer-links {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 2rem;
}

.login-footer-link {
    color: #c5cee0;
    font-size: 0.875rem;
    text-decoration: none;
    white-space: nowrap;
}

.login-footer-link:hover {
    color: #9db8ff;
}

@media (max-width: 767.98px) {
    .login-header {
        padding: 1.5rem 1.25rem 0;
    }

    .login-header-inner {
        gap: 1rem;
    }

    .login-header-actions {
        gap: 1rem;
    }

    .login-action {
        font-size: 0.9rem;
    }

    .login-header-actions .login-action-accent {
        margin-left: 0;
    }

    .login-main-nav {
        gap: 1.25rem;
        margin-top: 1.75rem;
        margin-right: 0;
        margin-left: 0;
    }

    .login-content {
        padding: 2rem 1.25rem 3rem;
    }

    .login-footer {
        padding: 1.5rem 1.25rem;
    }

    .login-footer-inner {
        flex-wrap: wrap;
        gap: 1rem;
    }

    .login-footer-links {
        gap: 1.25rem;
    }
}

@media (max-width: 359.98px) {
    .login-header-actions .login-action:first-child {
        display: none;
    }
}
CSS);
?>
<div class="login-page">
    <header class="login-header">
        <div class="login-header-inner">
            <a class="login-logo" href="<?= Url::home() ?>" aria-label="Página inicial">
                <span class="login-logo-mark" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                        <circle cx="7" cy="7" r="2.2" fill="#7a4a0a"/>
                        <circle cx="12" cy="5.5" r="2.2" fill="#7a4a0a"/>
                        <circle cx="17" cy="7" r="2.2" fill="#7a4a0a"/>
                        <path d="M12 11c-3 0-5.5 2.2-5.5 5 0 2 1.6 3.5 3.6 3.5h3.8c2 0 3.6-1.5 3.6-3.5 0-2.8-2.5-5-5.5-5Z" fill="#7a4a0a"/>
                    </svg>
                </span>
                <span>Logo</span>
            </a>

            <nav class="login-header-actions" aria-label="Ações da conta">
                <a class="login-action" href="#">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                        <path d="m16.5 16.5 4.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span>Procurar</span>
                </a>
                <?= Html::a('Entrar', ['site/login'], ['class' => 'login-action']) ?>
                <?= Html::a('Registar', ['site/signup'], ['class' => 'login-action login-action-accent']) ?>
            </nav>
        </div>

        <nav class="login-main-nav" aria-label="Navegação principal">
            <?= Html::a('Adotar', ['site/index'], ['class' => 'login-nav-link']) ?>
            <?= Html::a('Anunciar', ['site/signup'], ['class' => 'login-nav-link']) ?>
            <?= Html::a('Associações', ['site/about'], ['class' => 'login-nav-link']) ?>
            <?= Html::a('Sobre', ['site/about'], ['class' => 'login-nav-link']) ?>
            <a class="login-nav-link" href="#">FAQ</a>
        </nav>
    </header>

    <div class="login-content">
        <div class="login-form-wrap">
            <h1 class="login-title">Entrar</h1>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'login-form'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'options' => ['class' => 'login-field'],
                    'labelOptions' => ['class' => 'login-label'],
                    'inputOptions' => ['class' => 'login-input'],
                    'errorOptions' => ['class' => 'login-error'],
                ],
            ]); ?>

            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'class' => 'login-input',
                    'autocomplete' => 'username',
                    'autofocus' => true,
                ],
            ])->textInput()->label('Email', ['class' => 'login-label']) ?>

            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'class' => 'login-input',
                    'autocomplete' => 'current-password',
                ],
            ])->passwordInput()->label('Palavra-passe', ['class' => 'login-label']) ?>

            <?= Html::hiddenInput('LoginForm[rememberMe]', '1') ?>

            <div class="login-forgot">
                <?= Html::a(
                    'Esqueci-me da palavra-passe',
                    ['site/request-password-reset'],
                    ['class' => 'login-forgot-link'],
                ) ?>
            </div>

            <?= Html::submitButton('Entrar', [
                'class' => 'login-submit',
                'name' => 'login-button',
            ]) ?>

            <?php ActiveForm::end(); ?>

            <p class="login-signup">
                Ainda não tem conta?
                <?= Html::a('Registar', ['site/signup'], ['class' => 'login-signup-link']) ?>
            </p>
        </div>
    </div>

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
</div>
