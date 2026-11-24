<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Perfil;

/**
 * PerfilSearch representa o modelo por tras do formulario de pesquisa de `common\models\Perfil`.
 */
class PerfilSearch extends Perfil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'utilizador_id', 'tipo', 'biometria', 'associacao_id'], 'integer'],
            [['nome'], 'safe'],
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
        $query = Perfil::find();

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
            'utilizador_id' => $this->utilizador_id,
            'tipo' => $this->tipo,
            'biometria' => $this->biometria,
            'associacao_id' => $this->associacao_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}
