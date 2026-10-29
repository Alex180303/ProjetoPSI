<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Adocao $model */

$this->title = 'Create Adocao';
$this->params['breadcrumbs'][] = ['label' => 'Adocaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adocao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
