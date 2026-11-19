<?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\_form.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Formulario parcial reutilizavel para criacao e edicao.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Desconto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="desconto-form">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\_form.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'desconto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_validade')->textInput() ?>

    <?= $form->field($model, 'produto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adocao_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\_form.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
