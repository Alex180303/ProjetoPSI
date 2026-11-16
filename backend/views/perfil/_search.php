<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PerfilSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perfil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'utilizador_id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'biometria') ?>

    <?php // echo $form->field($model, 'associacao_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
