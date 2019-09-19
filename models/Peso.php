<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peso".
 *
 * @property int $id
 * @property int $avaliacao_id
 * @property double $valor
 * @property string $data
 *
 * @property Avaliacao $avaliacao
 */
class Peso extends \yii\db\ActiveRecord
{

    const SCENARIO_PESO = 'registro_peso';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peso';
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
                'on' => Peso::SCENARIO_PESO
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
            ['data', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'valor' => 'Peso',
        ];
    }

      public function beforeSave($insert)
    {
        if ($this->isNewRecord)
            $this->data = date('Y-m-d');

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacao()
    {
        return $this->hasOne(Avaliacao::className(), ['id' => 'avaliacao_id']);
    }
}
