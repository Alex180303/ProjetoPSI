<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AnimalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="animal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'idade') ?>

    <?= $form->field($model, 'sexo') ?>

    <?= $form->field($model, 'cor') ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'porte_id') ?>

    <?php // echo $form->field($model, 'especie_id') ?>

    <?php // echo $form->field($model, 'raca_id') ?>

    <?php // echo $form->field($model, 'utilizador_id') ?>

    <?php // echo $form->field($model, 'associacao_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
