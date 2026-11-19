<?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_search.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulario parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\FichaClinicaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ficha-clinica-search">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_search.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'animal_id') ?>

    <?= $form->field($model, 'vacinacao') ?>

    <?= $form->field($model, 'desparasitacao') ?>

    <?= $form->field($model, 'esterilizacao') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_search.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'historico_medico') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\_search.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
