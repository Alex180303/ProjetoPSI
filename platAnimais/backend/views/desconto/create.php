<?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\create.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Ecra de criacao de um novo registo (usa o formulario parcial quando aplicavel).
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Desconto $model */

$this->title = 'Create Desconto';
$this->params['breadcrumbs'][] = ['label' => 'Descontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desconto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
