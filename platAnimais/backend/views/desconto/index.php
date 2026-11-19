<?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\index.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Listagem de registos: inclui pesquisa/filtros e grelha com acoes de gestao.
 * Responsabilidade: apresentar dados e interacoes de UI recorrendo a widgets/helpers do Yii2.
 */

use common\models\Desconto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\DescontoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Descontos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desconto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Desconto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\desconto\index.php
 *
 * View do controller 'desconto' (backend CRUD).
 * Listagem de registos: inclui pesquisa/filtros e grelha com ações de gestão.
 * Responsabilidade: apresentar dados e interações de UI recorrendo a widgets/helpers do Yii2.
 */ // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desconto',
            'data_validade',
            'produto',
            'adocao_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Desconto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
