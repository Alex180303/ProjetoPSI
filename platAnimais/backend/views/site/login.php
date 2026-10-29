<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var backend\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Entrar no back-office';
$htmlIcon = <<<HTML
{label}<div class="input-group"><span class="input-group-text" aria-hidden="true">%s</span>{input}</div>{error}{hint}
HTML;
$labelOptions = ['class' => 'form-label fw-semibold small'];
?>
<div class="card border-0 overflow-hidden login-split-card">
    <div class="row g-0">

        <!-- Painel de marca -->
        <div class="col-md-5 d-none d-md-flex login-brand-panel text-white">
            <div class="d-flex flex-column justify-content-between p-4 p-lg-5 w-100">
                <div>
                    <span class="login-brand-mark" aria-hidden="true">&#128062;</span>
                </div>
                <div>
                    <p class="login-brand-eyebrow text-uppercase small fw-semibold mb-2">Back-office</p>
                    <h2 class="fw-bold mb-3 login-brand-title">
                        Plataforma de<br>Adoção de Animais
                    </h2>
                    <p class="opacity-75 mb-0 login-brand-text">
                        Área de gestão de animais, associações e pedidos de adoção.
                    </p>
                </div>
            </div>
        </div>

        <!-- Painel do formulário -->
        <div class="col-md-7">
            <div class="p-4 p-lg-5">
                <div class="text-center mb-4">
                    <!-- Marca visível apenas em ecrãs pequenos -->
                    <div class="d-md-none mb-3">
                        <span class="login-brand-mark login-brand-mark--mobile text-white" aria-hidden="true">&#128062;</span>
                    </div>
                    <h1 class="h3 fw-bold mb-1"><?= Html::encode($this->title) ?></h1>
                    <p class="text-body-secondary small mb-0">
                        Introduza as suas credenciais para continuar.
                    </p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'username', [
                        'options' => ['class' => 'mb-0'],
                        'template' => sprintf($htmlIcon, '&#128100;'),
                        'inputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'nome de utilizador',
                            'autofocus' => true,
                        ],
                    ])->textInput()->label('Nome de utilizador', $labelOptions) ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'password', [
                        'options' => ['class' => 'mb-0'],
                        'template' => sprintf($htmlIcon, '&#128274;'),
                        'inputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'palavra-passe',
                        ],
                    ])->passwordInput()->label('Palavra-passe', $labelOptions) ?>
                </div>

                <div class="mb-4">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>

                <div class="d-grid">
                    <?= Html::submitButton(
                        'Entrar',
                        [
                            'class' => 'btn login-btn btn-lg rounded-3 text-white',
                            'name' => 'login-button',
                        ],
                    ) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <p class="text-body-secondary text-center mt-4 mb-0 small">
                    Acesso reservado a contas autorizadas.
                </p>
            </div>
        </div>

    </div>
</div>
