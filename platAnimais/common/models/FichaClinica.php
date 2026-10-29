<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ficha_clinica".
 *
 * @property int $id
 * @property int $animal_id
 * @property string|null $vacinacao
 * @property string|null $desparasitacao
 * @property int $esterilizacao
 * @property string|null $historico_medico
 *
 * @property Animal $animal
 */
class FichaClinica extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ficha_clinica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacinacao', 'desparasitacao', 'historico_medico'], 'default', 'value' => null],
            [['esterilizacao'], 'default', 'value' => 0],
            [['animal_id'], 'required'],
            [['animal_id', 'esterilizacao'], 'integer'],
            [['vacinacao', 'desparasitacao', 'historico_medico'], 'string'],
            [['animal_id'], 'unique'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::class, 'targetAttribute' => ['animal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'animal_id' => 'Animal ID',
            'vacinacao' => 'Vacinacao',
            'desparasitacao' => 'Desparasitacao',
            'esterilizacao' => 'Esterilizacao',
            'historico_medico' => 'Historico Medico',
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

}
