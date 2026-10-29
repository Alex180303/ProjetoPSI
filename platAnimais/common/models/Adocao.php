<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adocao".
 *
 * @property int $id
 * @property string $data_submissao
 * @property int $estado
 * @property int $animal_id
 * @property int $utilizador_id
 *
 * @property Animal $animal
 * @property User $utilizador
 */
class Adocao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adocao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'default', 'value' => 0],
            [['data_submissao'], 'safe'],
            [['estado', 'animal_id', 'utilizador_id'], 'integer'],
            [['animal_id', 'utilizador_id'], 'required'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::class, 'targetAttribute' => ['animal_id' => 'id']],
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
            'data_submissao' => 'Data Submissao',
            'estado' => 'Estado',
            'animal_id' => 'Animal ID',
            'utilizador_id' => 'Utilizador ID',
        ];
    }

    /**
     * Gets query for [[Animal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animal::class, ['id' => 'animal_id']);
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
