<?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_form.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulario parcial reutilizavel para criacao e edicao.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FichaClinica $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ficha-clinica-form">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_form.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'vacinacao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desparasitacao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'esterilizacao')->textInput() ?>

    <?= $form->field($model, 'historico_medico')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_form.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulário parcial reutilizável para criação e edição.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
