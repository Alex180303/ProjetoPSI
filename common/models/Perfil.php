<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property int $utilizador_id
 * @property string $nome
 * @property int $tipo
 * @property int $biometria
 * @property int|null $associacao_id
 */
class Perfil extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['associacao_id'], 'default', 'value' => null],
            [['biometria'], 'default', 'value' => 0],
            [['utilizador_id', 'nome'], 'required'],
            [['utilizador_id', 'tipo', 'biometria', 'associacao_id'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['utilizador_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'utilizador_id' => 'Utilizador ID',
            'nome' => 'Nome',
            'tipo' => 'Tipo',
            'biometria' => 'Biometria',
            'associacao_id' => 'Associacao ID',
        ];
    }

}
