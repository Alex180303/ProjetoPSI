<?php
/**
 * Ficheiro de view: platAnimais\backend\views\animal\view.php
 *
 * View do controller 'animal' (backend CRUD).
 * Detalhe de um registo especifico.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Animal $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="animal-view">

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
            'nome',
            'idade',
            'sexo',
            'cor',
            'descricao:ntext',
            'porte_id',
            'especie_id',
            'raca_id',
            'utilizador_id',
            'associacao_id',
        ],
    ]) ?>

</div>
