<?php

namespace frontend\controllers;

class AnimalController
{
    public function actionCreate()
    {
        if (!Yii::$app->user->can('criarAnimal')) {
            throw new \yii\web\ForbiddenHttpException();
        }

        // Código da ação para criar o animal
    }
}