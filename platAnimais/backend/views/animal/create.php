<?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\create.php
 *
 * View do controller 'animal' (backend CRUD).
 * Ecra de criacao de um novo registo (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Animal $model */

$this->title = 'Create Animal';
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
