<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avaliacao".
 *
 * @property int $id
 * @property int $pessoa_id
 * @property string $data
 * @property int $altura
 * @property int $nome
 *
 * @property Pessoa $pessoa
 * @property Imc[] $imcs
 * @property PercentualGordura[] $percentualGorduras
 * @property Peso[] $pesos
 */
class Avaliacao extends \yii\db\ActiveRecord
{

    const SCENARIO_AVALIACAO = 'avaliacao';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['pessoa_id', 'required', 'on' => Avaliacao::SCENARIO_AVALIACAO],
            ['nome', 'required'],
            [['pessoa_id', 'altura'], 'integer'],
            ['nome', 'string'],
            [['data'], 'safe'],
            [
                ['pessoa_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Pessoa::className(),
                'targetAttribute' => ['pessoa_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'altura' => 'Altura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoa()
    {
        return $this->hasOne(Pessoa::className(), ['id' => 'pessoa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImcs()
    {
        return $this->hasMany(Imc::className(), ['avaliacao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentualGorduras()
    {
        return $this->hasMany(PercentualGordura::className(), ['avaliacao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesos()
    {
        return $this->hasMany(Peso::className(), ['avaliacao_id' => 'id']);
    }
}
