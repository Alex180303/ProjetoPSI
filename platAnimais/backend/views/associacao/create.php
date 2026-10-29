<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Associacao $model */

$this->title = 'Create Associacao';
$this->params['breadcrumbs'][] = ['label' => 'Associacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="associacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
