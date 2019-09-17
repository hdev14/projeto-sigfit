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
 * @property string $titulo
 * @property int $idade
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
            [['titulo', 'altura', 'idade'], 'required'],
            [['pessoa_id', 'altura', 'idade'], 'integer'],
            ['titulo', 'string'],
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
            'titulo' => 'Título',
            'altura' => 'Altura',
            'idade' => 'Idade',
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

    public function getPdgData() {
        $pdgs = $this->percentualGorduras;
        $data = [];
        foreach ($pdgs as $pdg) {
            array_push($data, $pdg->valor);
        }
        return implode(',', $data);
    }
}
