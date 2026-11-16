<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Adocao $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="adocao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_submissao')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'utilizador_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
