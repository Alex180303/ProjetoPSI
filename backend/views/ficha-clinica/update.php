<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FichaClinica $model */

$this->title = 'Update Ficha Clinica: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ficha Clinicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ficha-clinica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
