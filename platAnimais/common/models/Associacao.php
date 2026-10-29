<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "associacao".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $morada
 * @property string|null $telefone
 * @property float|null $latitude
 * @property float|null $longitude
 */
class Associacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'associacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['morada', 'telefone', 'latitude', 'longitude'], 'default', 'value' => null],
            [['nome'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['nome'], 'string', 'max' => 150],
            [['morada'], 'string', 'max' => 255],
            [['telefone'], 'string', 'max' => 20],
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
            'morada' => 'Morada',
            'telefone' => 'Telefone',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

}
