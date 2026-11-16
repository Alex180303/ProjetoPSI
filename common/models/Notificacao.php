<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property int $id
 * @property string $mensagem
 * @property int|null $utilizador_id
 *
 * @property User $utilizador
 */
class Notificacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['utilizador_id'], 'default', 'value' => null],
            [['mensagem'], 'required'],
            [['mensagem'], 'string'],
            [['utilizador_id'], 'integer'],
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
            'mensagem' => 'Mensagem',
            'utilizador_id' => 'Utilizador ID',
        ];
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
