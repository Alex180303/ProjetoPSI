<?php

use common\models\FichaClinica;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\FichaClinicaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ficha Clinicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-clinica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ficha Clinica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'animal_id',
            'vacinacao:ntext',
            'desparasitacao:ntext',
            'esterilizacao',
            //'historico_medico:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FichaClinica $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
