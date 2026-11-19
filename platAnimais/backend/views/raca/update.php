<?php
/**
 * Ficheiro de view: platAnimais\backend\views\raca\update.php
 *
 * View do controller 'raca' (backend CRUD).
 * Ecra de edicao de um registo existente (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Raca $model */

$this->title = 'Update Raca: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Racas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="raca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
