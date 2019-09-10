<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imc".
 *
 * @property int $id
 * @property int $avaliacao_id
 * @property double $valor
 *
 * @property Avaliacao $avaliacao
 */
class Imc extends \yii\db\ActiveRecord
{
    const SCENARIO_IMC = 'registro_imc';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                'avaliacao_id',
                'required',
                'on' => Imc::SCENARIO_IMC
            ],
            ['valor', 'required'],
            [['avaliacao_id'], 'integer'],
            [['valor'], 'number'],
            [
                ['avaliacao_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Avaliacao::className(),
                'targetAttribute' => ['avaliacao_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'valor' => 'Índice de massa corporal (IMC)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacao()
    {
        return $this->hasOne(Avaliacao::className(), ['id' => 'avaliacao_id']);
    }
}
