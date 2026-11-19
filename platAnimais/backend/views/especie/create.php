<?php
/**
 * Ficheiro de view: platAnimais\backend\views\especie\create.php
 *
 * View do controller 'especie' (backend CRUD).
 * Ecra de criacao de um novo registo (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Especie $model */

$this->title = 'Create Especie';
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
