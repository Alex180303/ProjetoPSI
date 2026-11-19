<?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\create.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Ecra de criacao de um novo registo (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

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
