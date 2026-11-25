<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class AnimaisController extends ActiveController
{

    public $modelClass = 'common\models\Animal';


    public function actionCount()
    {
        // Instancia o modelo apenas para aceder à query (poderia usar diretamente Animal::find()).
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

    public function actionCor()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['cor'])->all();
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
        // Lê o novo valor de idade enviado no pedido.
        $nova_idade = \Yii::$app->request->post('idade');
        $animalModel = new $this->modelClass;

        // Procura um registo pelo nome e atualiza o campo idade.
        $ret = $animalModel::findOne(['nome' => $nomeanimal]);
        if ($ret) {
            $ret->idade = $nova_idade;
            $ret->save();
        } else {
            throw new \yii\web\NotFoundHttpException("Nome de animal não existe");
        }
    }

    public function actionEspeciepornome($nomeanimal)
    {
        $animalModel = new $this->modelClass;
        return $animalModel::find()->select(['especie'])->where(['nome' => $nomeanimal])->all();
    }

    public function actionPostanimalvazio()
    {
        $animalmodel = new $this->modelClass;
        $animalmodel->nome = 'Sem nome';
        $animalmodel->idade = 0;
        $animalmodel->sexo = 0;
        $animalmodel->especie_id = 1;
        $animalmodel->cor = ' ';
        $animalmodel->descricao = ' ';
        $animalmodel->save();

        return $animalmodel;
    }
}