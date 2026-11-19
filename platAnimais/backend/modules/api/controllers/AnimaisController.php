<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Controlador REST da API para o recurso "Animais".
 *
 * Estende ActiveController do Yii2, que disponibiliza automaticamente ações REST padrão
 * (index, view, create, update, delete, etc.) com base em `$modelClass`.
 *
 * Neste projeto também são definidas ações extra (mapeadas em backend/config/main.php via UrlRule)
 * para operações específicas como contagens e consultas/alterações por nome.
 *
 * Nota: este exemplo não define explicitamente autenticação/autorização (behaviors de auth/RBAC/rate-limit).
 * Num ambiente real, deve avaliar-se se é necessário proteger estes endpoints.
 */
class AnimaisController extends ActiveController
{
    /**
     * Modelo ActiveRecord associado ao recurso exposto pela API.
     * O ActiveController usa esta classe para CRUD e serialização de dados.
     */
    public $modelClass = 'common\models\Animal';

    /**
     * GET /api/animais/count
     * Devolve o número total de registos de animais existentes.
     */
    public function actionCount()
    {
        // Instancia o modelo apenas para aceder à query (poderia usar diretamente Animal::find()).
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->all();
        return ['count' => count($recs)];
    }

    /**
     * GET /api/animais/nomes
     * Devolve apenas o campo "nome" de todos os animais.
     */
    public function actionNomes()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['nome'])->all();
        return $recs;
    }

    /**
     * GET /api/animais/especie
     * Devolve apenas o campo "especie" de todos os animais.
     */
    public function actionEspecie()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['especie'])->all();
        return $recs;
    }

    /**
     * GET /api/animais/idade
     * Devolve apenas o campo "idade" de todos os animais.
     */
    public function actionIdade()
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['idade'])->all();
        return $recs;
    }

    /**
     * GET /api/animais/idade/{nomeanimal}
     * Devolve a(s) idade(s) dos animais cujo nome corresponda ao parâmetro indicado.
     *
     * @param string $nomeanimal Nome do animal a pesquisar (token definido na regra de URL).
     */
    public function actionIdadepornome($nomeanimal)
    {
        $animalModel = new $this->modelClass;
        $recs = $animalModel::find()->select(['idade'])->where(['nome' => $nomeanimal])->all();
        return $recs;
    }

    /**
     * DELETE /api/animais/{nomeanimal}
     * Remove todos os registos de animais com o nome indicado.
     *
     * @param string $nomeanimal Nome do animal a eliminar.
     * @return int Número de registos apagados.
     */
    public function actionDelpornome($nomeanimal)
    {
        $animalModel = new $this->modelClass;
        $resc = $animalModel::deleteAll(['nome' => $nomeanimal]);
        return $resc;
    }

    /**
     * PUT /api/animais/{nomeanimal}
     * Atualiza a idade do primeiro animal encontrado com o nome indicado.
     *
     * Espera receber `idade` no corpo do pedido (POST/PUT form data).
     * Lança 404 se não existir um animal com esse nome.
     *
     * @param string $nomeanimal Nome do animal a atualizar.
     * @throws \yii\web\NotFoundHttpException
     */
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
}