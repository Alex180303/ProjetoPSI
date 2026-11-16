<?php

namespace backend\models;

use common\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 *
 * Nota: ao contrário de `User::findIdentity()` (que só devolve contas ativas),
 * este Search NÃO filtra por estado, para que as contas eliminadas
 * (status = User::STATUS_DELETED) continuem visíveis na listagem do back-office.
 */
class UserSearch extends User
{
    /**
     * Papel (RBAC) pelo qual filtrar. Não é uma coluna da tabela `user`;
     * é resolvido através da tabela `auth_assignment`.
     *
     * @var string|null
     */
    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'role'], 'safe'],
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
     * Rótulos legíveis dos estados possíveis de uma conta.
     *
     * @return array<int, string>
     */
    public static function statusLabels()
    {
        return [
            User::STATUS_ACTIVE => 'Ativo',
            User::STATUS_INACTIVE => 'Inativo',
            User::STATUS_DELETED => 'Eliminado',
        ];
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
            ],
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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        if (!empty($this->role)) {
            $userIds = (new Query())
                ->select('user_id')
                ->from('{{%auth_assignment}}')
                ->where(['item_name' => $this->role]);
            $query->andWhere(['id' => $userIds]);
        }

        return $dataProvider;
    }
}
