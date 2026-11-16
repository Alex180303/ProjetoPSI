<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Registar';
$this->params['meta_description'] = 'Criar conta na plataforma de adoção de animais.';
$this->params['meta_keywords'] = 'registar, criar conta, adoção, animais, associações';

?>
<div class="login-page">

    <div class="login-content">
        <div class="login-form-wrap">
            <h1 class="login-title">Registar</h1>

            <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
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
            ])->textInput()->label('Nome de utilizador', ['class' => 'login-label']) ?>

            <?= $form->field($model, 'email', [
                    'inputOptions' => [
                            'class' => 'login-input',
                            'autocomplete' => 'email',
                    ],
            ])->input('email')->label('Email', ['class' => 'login-label']) ?>

            <?= $form->field($model, 'password', [
                    'inputOptions' => [
                            'class' => 'login-input',
                            'autocomplete' => 'new-password',
                    ],
            ])->passwordInput()->label('Palavra-passe', ['class' => 'login-label']) ?>

            <?= Html::submitButton('Criar conta', [
                    'class' => 'login-submit',
                    'name' => 'signup-button',
            ]) ?>

            <?php ActiveForm::end(); ?>

            <p class="login-signup">
                Já tem conta?
                <?= Html::a('Entrar', ['site/login'], ['class' => 'login-signup-link']) ?>
            </p>
        </div>
    </div>
</div>