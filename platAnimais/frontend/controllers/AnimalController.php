<?php

namespace frontend\controllers;

use Yii;

class AnimalController extends Controller
{
    public function actionCreate()
    {
        if (!Yii::$app->user->can('criarAnimal')) {
            throw new \yii\web\ForbiddenHttpException();
        }

        // Código da ação para criar o animal
    }
}