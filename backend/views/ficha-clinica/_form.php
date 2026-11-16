<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FichaClinica $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ficha-clinica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'vacinacao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desparasitacao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'esterilizacao')->textInput() ?>

    <?= $form->field($model, 'historico_medico')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
