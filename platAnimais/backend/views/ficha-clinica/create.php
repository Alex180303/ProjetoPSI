<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FichaClinica $model */

$this->title = 'Create Ficha Clinica';
$this->params['breadcrumbs'][] = ['label' => 'Ficha Clinicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-clinica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
