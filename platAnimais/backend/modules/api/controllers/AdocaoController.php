<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;


class AdocaoController extends ActiveController
{
    public $modelClass = 'common\models\Adocao';


    public function actionAprovado($id)
    {
        return $this->mudarEstado($id, 2);
    }

    public function actionPendente($id)
    {
        return $this->mudarEstado($id, 1);
    }

    public function actionRejeitado($id)
    {
        return $this->mudarEstado($id, 0);
    }

    private function mudarEstado($id, $estado)
    {
        $modelClass = $this->modelClass;
        $adocao = $modelClass::findOne($id);

        if ($adocao === null) {
            throw new NotFoundHttpException('Adoção não encontrada.');
        }

        $adocao->estado = $estado;
        $adocao->save();

        return $adocao;
    }
}