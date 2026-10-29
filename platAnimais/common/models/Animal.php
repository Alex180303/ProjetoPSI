<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property string $nome
 * @property int|null $idade
 * @property int $sexo
 * @property string|null $cor
 * @property string|null $descricao
 * @property int|null $porte_id
 * @property int $especie_id
 * @property int|null $raca_id
 * @property int|null $utilizador_id
 * @property int|null $associacao_id
 *
 * @property Especie $especie
 * @property Raca $especie0
 * @property User $utilizador
 */
class Animal extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idade', 'cor', 'descricao', 'porte_id', 'raca_id', 'utilizador_id', 'associacao_id'], 'default', 'value' => null],
            [['nome', 'sexo', 'especie_id'], 'required'],
            [['idade', 'sexo', 'porte_id', 'especie_id', 'raca_id', 'utilizador_id', 'associacao_id'], 'integer'],
            [['descricao'], 'string'],
            [['nome'], 'string', 'max' => 100],
            [['cor'], 'string', 'max' => 50],
            [['especie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especie::class, 'targetAttribute' => ['especie_id' => 'id']],
            [['especie_id', 'raca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Raca::class, 'targetAttribute' => ['especie_id' => 'especie_id', 'raca_id' => 'id']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['utilizador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'idade' => 'Idade',
            'sexo' => 'Sexo',
            'cor' => 'Cor',
            'descricao' => 'Descricao',
            'porte_id' => 'Porte ID',
            'especie_id' => 'Especie ID',
            'raca_id' => 'Raca ID',
            'utilizador_id' => 'Utilizador ID',
            'associacao_id' => 'Associacao ID',
        ];
    }

    /**
     * Gets query for [[Especie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie()
    {
        return $this->hasOne(Especie::class, ['id' => 'especie_id']);
    }

    /**
     * Gets query for [[Especie0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie0()
    {
        return $this->hasOne(Raca::class, ['especie_id' => 'especie_id', 'id' => 'raca_id']);
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(User::class, ['id' => 'utilizador_id']);
    }

}
