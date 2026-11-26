<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class FichaClinicaController extends ActiveController
{
    public $modelClass = 'common\models\FichaClinica';



    public function actionVacinacao()
    {
        $modelClass = new $this->modelClass;
        $recs = $modelClass::find()->select(['vacinacao'])->all();
        return $recs;
    }


    public function actionDesparasitacao()
    {
        $modelClass = new $this->modelClass;
        $recs = $modelClass::find()->select(['desparasitacao'])->all();
        return $recs;
    }


    public function actionEsterilizacao()
    {
        $modelClass = new $this->modelClass;
        $recs = $modelClass::find()->select(['vacinacao'])->all();
        return $recs;
    }

    public function actionPorAnimal($animal_id)
    {
        $modelClass = $this->modelClass;
        return $modelClass::find()->where(['animal_id' => $animal_id])->all();
    }



    public function actionPostfichaclinica()
    {
        $fichamodel = new $this->modelClass;
        $fichamodel->vacinacao = 'sem';
        $fichamodel->desparasitacao = 'sem';
        $fichamodel->esterilizacao = 0;
        $fichamodel->historico_medico = 'sem';
        $fichamodel->animal_id = 4;
        $fichamodel->save();

        return $fichamodel;
    }
}
