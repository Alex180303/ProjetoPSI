<?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\view.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Detalhe de um registo especifico.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Desconto $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Descontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="desconto-view">

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
            'desconto',
            'data_validade',
            'produto',
            'adocao_id',
        ],
    ]) ?>

</div>
