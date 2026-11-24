<?php

namespace common\models;

use Yii;

/**
 * Esta e a classe de modelo para a tabela "desconto".
 *
 * @property int $id
 * @property float $desconto
 * @property string $data_validade
 * @property string $produto
 * @property int|null $adocao_id
 */
class Desconto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desconto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adocao_id'], 'default', 'value' => null],
            [['desconto', 'data_validade', 'produto'], 'required'],
            [['desconto'], 'number'],
            [['data_validade'], 'safe'],
            [['adocao_id'], 'integer'],
            [['produto'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desconto' => 'Desconto',
            'data_validade' => 'Data Validade',
            'produto' => 'Produto',
            'adocao_id' => 'Adocao ID',
        ];
    }

}
