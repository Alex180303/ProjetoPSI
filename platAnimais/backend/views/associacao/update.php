<?php
/**
 * Ficheiro de view: platAnimais\backend\views\associacao\update.php
 *
 * View do controller 'associacao' (backend CRUD).
 * Ecra de edicao de um registo existente (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Associacao $model */

$this->title = 'Update Associacao: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Associacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="associacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
