<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "percentual_gordura".
 *
 * @property int $id
 * @property int $avaliacao_id
 * @property double $valor
 *
 * @property Avaliacao $avaliacao
 */
class PercentualGordura extends \yii\db\ActiveRecord
{
    const SCENARIO_PG = 'registro_pg';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'percentual_gordura';
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
                'on' => PercentualGordura::SCENARIO_PG
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
            'valor' => 'Percentual de Gordura',
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
