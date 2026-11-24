<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FichaClinica;

/**
 * FichaClinicaSearch representa o modelo por tras do formulario de pesquisa de `common\models\FichaClinica`.
 */
class FichaClinicaSearch extends FichaClinica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'animal_id', 'esterilizacao'], 'integer'],
            [['vacinacao', 'desparasitacao', 'historico_medico'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // ignora a implementacao de scenarios() da classe pai
        return Model::scenarios();
    }

    /**
     * Cria uma instancia do data provider com a query de pesquisa aplicada
     *
     * @param array $params
     * @param string|null $formName Nome do formulario a utilizar no metodo `->load()`.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = FichaClinica::find();

        // adiciona condicoes que devem ser sempre aplicadas aqui

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // descomente a linha seguinte se nao quiser devolver quaisquer registos quando a validacao falhar
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'animal_id' => $this->animal_id,
            'esterilizacao' => $this->esterilizacao,
        ]);

        $query->andFilterWhere(['like', 'vacinacao', $this->vacinacao])
            ->andFilterWhere(['like', 'desparasitacao', $this->desparasitacao])
            ->andFilterWhere(['like', 'historico_medico', $this->historico_medico]);

        return $dataProvider;
    }
}
