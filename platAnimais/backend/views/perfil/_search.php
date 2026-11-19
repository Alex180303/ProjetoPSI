<?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_search.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulario parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PerfilSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perfil-search">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_search.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'utilizador_id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'biometria') ?>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_search.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $form->field($model, 'associacao_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\perfil\_search.php
 *
 * View do controller 'perfil' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
