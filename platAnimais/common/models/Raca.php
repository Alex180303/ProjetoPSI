<?php

namespace common\models;

/**
 * This is the model class for table "raca".
 *
 * @property int $id
 * @property string $nome
 * @property int $especie_id
 *
 * @property Especie $especie
 */
class Raca extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'especie_id'], 'required'],
            [['especie_id'], 'integer'],
            [['nome'], 'string', 'max' => 80],
            [['especie_id', 'nome'], 'unique', 'targetAttribute' => ['especie_id', 'nome']],
            [['especie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especie::class, 'targetAttribute' => ['especie_id' => 'id']],
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
            'especie_id' => 'Especie ID',
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

}
