<?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\login.php
 *
 * View do controlador Site (paginas gerais, autenticacao e informacao).
 * Pagina de login: formulario de autenticacao processado por SiteController::actionLogin.
 * Responsabilidade: renderizar a interface (HTML/formularios/widgets) com os dados fornecidos pelo controller.
 */

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

    <div class="login-content">
        <div class="login-form-wrap">
            <h1 class="login-title">Entrar</h1>

            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\login.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página de login: formulário de autenticação processado por SiteController::actionLogin.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ $form = ActiveForm::begin([
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

            <?= $form->field($model, 'email', [
                'inputOptions' => [
                    'class' => 'login-input',
                    'autocomplete' => 'email',
                    'autofocus' => true,
                ],
            ])->input('email')->label('Email', ['class' => 'login-label']) ?>

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

            <?php
/**
 * Ficheiro de view: platAnimais\frontend\views\site\login.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página de login: formulário de autenticação processado por SiteController::actionLogin.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ ActiveForm::end(); ?>

            <p class="login-signup">
                Ainda não tem conta?
                <?= Html::a('Registar', ['site/signup'], ['class' => 'login-signup-link']) ?>
            </p>
        </div>
    </div>
</div>
