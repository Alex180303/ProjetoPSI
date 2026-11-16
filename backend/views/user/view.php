<?php

use backend\models\UserSearch;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$statusLabels = UserSearch::statusLabels();
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ((int) $model->status === User::STATUS_DELETED): ?>
            <?= Html::a('Reativar', ['restore', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Reativar este utilizador?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que quer eliminar este utilizador?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email',
            [
                'attribute' => 'status',
                'value' => $statusLabels[$model->status] ?? $model->status,
            ],
            [
                'label' => 'Papéis',
                'value' => implode(', ', array_keys(Yii::$app->authManager->getRolesByUser($model->id))) ?: '—',
            ],
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d/m/Y H:i'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime', 'php:d/m/Y H:i'],
            ],
        ],
    ]) ?>

</div>
