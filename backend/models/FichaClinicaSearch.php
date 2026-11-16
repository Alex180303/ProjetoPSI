<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FichaClinica;

/**
 * FichaClinicaSearch represents the model behind the search form of `common\models\FichaClinica`.
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
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = FichaClinica::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
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
