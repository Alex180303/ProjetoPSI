<?php

namespace common\models;

/**
 * This is the model class for table "especie".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Raca[] $racas
 */
class Especie extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 50],
            [['nome'], 'unique'],
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
        ];
    }

    /**
     * Gets query for [[Racas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRacas()
    {
        return $this->hasMany(Raca::class, ['especie_id' => 'id']);
    }

}
