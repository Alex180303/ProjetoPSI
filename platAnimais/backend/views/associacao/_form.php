<?php
/**
 * Ficheiro de view: platAnimais\backend\views\associacao\_form.php
 *
 * View do controller 'associacao' (backend CRUD).
 * Formulario parcial reutilizavel para criacao e edicao.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Associacao $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="associacao-form">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\associacao\_form.php
 *
 * View do controller 'associacao' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\associacao\_form.php
 *
 * View do controller 'associacao' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
