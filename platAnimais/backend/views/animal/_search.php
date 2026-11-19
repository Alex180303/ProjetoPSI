<?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulario parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AnimalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="animal-search">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'idade') ?>

    <?= $form->field($model, 'sexo') ?>

    <?= $form->field($model, 'cor') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'descricao') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'porte_id') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'especie_id') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'raca_id') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'utilizador_id') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'associacao_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\_search.php
 *
 * View do controller 'animal' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
