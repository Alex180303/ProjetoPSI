<?php

use backend\models\UserForm;
use backend\models\UserSearch;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;

$statusLabels = UserSearch::statusLabels();
$statusBadges = [
    User::STATUS_ACTIVE => 'badge badge-success',
    User::STATUS_INACTIVE => 'badge badge-warning',
    User::STATUS_DELETED => 'badge badge-danger',
];
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar utilizador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            [
                'attribute' => 'status',
                'filter' => $statusLabels,
                'format' => 'raw',
                'value' => function (User $model) use ($statusLabels, $statusBadges) {
                    $label = $statusLabels[$model->status] ?? $model->status;
                    $class = $statusBadges[$model->status] ?? 'badge badge-secondary';

                    return Html::tag('span', $label, ['class' => $class]);
                },
            ],
            [
                'attribute' => 'role',
                'label' => 'Papéis',
                'filter' => UserForm::availableRoles(),
                'value' => function (User $model) {
                    return implode(', ', array_keys(Yii::$app->authManager->getRolesByUser($model->id)));
                },
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
                'format' => ['datetime', 'php:d/m/Y H:i'],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {restore}',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('<span class="fas fa-eye"></span>', $url, ['title' => 'Ver']);
                    },
                    'update' => function ($url, User $model) {
                        if ((int) $model->status === User::STATUS_DELETED) {
                            return '';
                        }

                        return Html::a('<span class="fas fa-pencil-alt"></span>', $url, ['title' => 'Editar']);
                    },
                    'delete' => function ($url, User $model) {
                        if ((int) $model->status === User::STATUS_DELETED) {
                            return '';
                        }

                        return Html::a('<span class="fas fa-trash"></span>', $url, [
                            'title' => 'Eliminar',
                            'data' => [
                                'confirm' => 'Tem a certeza que quer eliminar este utilizador?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'restore' => function ($url, User $model) {
                        if ((int) $model->status !== User::STATUS_DELETED) {
                            return '';
                        }

                        return Html::a('<span class="fas fa-undo"></span>', $url, [
                            'title' => 'Reativar',
                            'data' => [
                                'confirm' => 'Reativar este utilizador?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
