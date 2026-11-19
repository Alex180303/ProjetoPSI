<?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\login.php
 *
 * View do controlador Site (paginas gerais, autenticacao e informacao).
 * Pagina de login: formulario de autenticacao processado por SiteController::actionLogin.
 * Responsabilidade: renderizar a interface (HTML/formularios/widgets) com os dados fornecidos pelo controller.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LoginForm $model */

$this->title = 'Iniciar sessão';
?>

<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">

            <div class="login-logo">
                <b>Plat</b>Animais
            </div>

            <p class="login-box-msg">
                Inicia sessão para aceder ao Backoffice
            </p>

            <?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\login.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página de login: formulário de autenticação processado por SiteController::actionLogin.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ $form = ActiveForm::begin([
                    'id' => 'login-form',
            ]); ?>

            <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Nome de utilizador',
            ])->label('Utilizador') ?>

            <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Palavra-passe',
            ])->label('Palavra-passe') ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="icheck-primary">{input} {label}</div>',
            ]) ?>

            <div class="row">
                <div class="col-12">
                    <?= Html::submitButton('Iniciar sessão', [
                            'class' => 'btn btn-primary btn-block',
                            'name' => 'login-button',
                    ]) ?>
                </div>
            </div>

            <?php
/**
 * Ficheiro de view: platAnimais\backend\views\site\login.php
 *
 * View do controlador Site (páginas gerais, autenticação e informação).
 * Página de login: formulário de autenticação processado por SiteController::actionLogin.
 * Responsabilidade: renderizar a interface (HTML/formulários/widgets) com os dados fornecidos pelo controller.
 */ ActiveForm::end(); ?>

        </div>
    </div>
</div>