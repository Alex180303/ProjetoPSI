<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

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

            <?php $form = ActiveForm::begin([
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

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>