<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Porte $model */

$this->title = 'Create Porte';
$this->params['breadcrumbs'][] = ['label' => 'Portes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="porte-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
