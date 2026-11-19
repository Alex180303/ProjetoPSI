<?php
/**
 * Ficheiro de view: platAnimais\backend\views\porte\create.php
 *
 * View do controller 'porte' (backend CRUD).
 * Ecra de criacao de um novo registo (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

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
