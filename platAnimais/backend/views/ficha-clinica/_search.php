<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\FichaClinicaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ficha-clinica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'animal_id') ?>

    <?= $form->field($model, 'vacinacao') ?>

    <?= $form->field($model, 'desparasitacao') ?>

    <?= $form->field($model, 'esterilizacao') ?>

    <?php // echo $form->field($model, 'historico_medico') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
