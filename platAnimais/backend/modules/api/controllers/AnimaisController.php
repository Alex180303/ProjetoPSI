<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class AnimaisController extends ActiveController
{
    public $modelClass = 'common\models\Animal';

    public function actionCount()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->all();
        return ['count' => count($recs)];
    }

    public function actionNomes()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['nome'])->all();
        return $recs;
    }

    public function actionEspecie()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['especie'])->all();
        return $recs;
    }

    public function actionIdade()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['idade'])->all();
        return $recs;
    }

    public function actionIdadepornome($nomeanimal)
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['idade'])->where(['nome' => $nomeanimal])->all();
        return $recs;
    }

    public function actionDelpornome($nomeanimal)
    {
        $animalModel = new $this->modelClass;
        $resc = $animalModel::deleteAll(['nome' => $nomeanimal]);
        return $resc;
    }

    public function actionPutidadepornome($nomeanimal)
    {
        $nova_idade = \Yii::$app->request->post('idade');
        $animalModel = new $this->modelClass;
        $ret = $animalModel::findOne(['nome' => $nomeanimal]);
        if ($ret) {
            $ret->idade = $nova_idade;
            $ret->save();
        } else {
            throw new \yii\web\NotFoundHttpException("Nome de animal não existe");
        }
    }
}