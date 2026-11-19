<?php
/**
 * Ficheiro de view: platAnimais\backend\views\ficha-clinica\view.php
 *
 * View do controller 'ficha-clinica' (backend CRUD).
 * Detalhe de um registo especifico.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\FichaClinica $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ficha Clinicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ficha-clinica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'animal_id',
            'vacinacao:ntext',
            'desparasitacao:ntext',
            'esterilizacao',
            'historico_medico:ntext',
        ],
    ]) ?>

</div>
