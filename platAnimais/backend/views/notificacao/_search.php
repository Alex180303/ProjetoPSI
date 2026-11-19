<?php
/**
 * Ficheiro de view: platAnimais\backend\views\notificacao\_search.php
 *
 * View do controller 'notificacao' (backend CRUD).
 * Formulario parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\NotificacaoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notificacao-search">

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\notificacao\_search.php
 *
 * View do controller 'notificacao' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mensagem') ?>

    <?= $form->field($model, 'utilizador_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\notificacao\_search.php
 *
 * View do controller 'notificacao' (backend CRUD).
 * Formulário parcial de pesquisa/filtros para a listagem.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ ActiveForm::end(); ?>

</div>
