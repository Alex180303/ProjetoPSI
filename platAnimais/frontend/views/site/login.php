<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\HttpException;

$this->title = 'Entrar';
$this->params['meta_description'] = 'Entrar na plataforma de adoção de animais.';
$this->params['meta_keywords'] = 'entrar, login, adoção, animais, associações';

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
