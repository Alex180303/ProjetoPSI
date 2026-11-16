<?php

use backend\models\UserForm;
use backend\models\UserSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UserForm $model */
/** @var yii\widgets\ActiveForm $form */

$isNew = $model->getUser()->isNewRecord;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')
        ->passwordInput(['autocomplete' => 'new-password'])
        ->hint($isNew ? null : 'Deixe em branco para manter a palavra-passe atual.') ?>

    <?= $form->field($model, 'status')->dropDownList(UserSearch::statusLabels()) ?>

    <?= $form->field($model, 'roles')->checkboxList(UserForm::availableRoles()) ?>

    <div class="form-group">
        <?= Html::submitButton($isNew ? 'Criar' : 'Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
