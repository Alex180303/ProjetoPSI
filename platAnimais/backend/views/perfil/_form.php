<?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_form.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulario parcial reutilizavel para criacao e edicao.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Perfil $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perfil-form">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_form.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'utilizador_id')->textInput() ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'biometria')->textInput() ?>

    <?= $form->field($model, 'associacao_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_form.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
