<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frequencia".
 *
 * @property int $id
 * @property int $pessoa_id
 * @property string $data
 * @property string $horario_inicio
 * @property string $horario_final
 *
 * @property Pessoa $pessoa
 */
class Frequencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frequencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pessoa_id', 'data', 'horario_inicio'], 'required'],
            [['pessoa_id'], 'integer'],
            [['data', 'horario_inicio', 'horario_final'], 'safe'],
            [['pessoa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['pessoa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pessoa_id' => Yii::t('app', 'Pessoa ID'),
            'data' => Yii::t('app', 'Data'),
            'horario_inicio' => Yii::t('app', 'Horario Inicio'),
            'horario_final' => Yii::t('app', 'Horario Final'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoa()
    {
        return $this->hasOne(Pessoa::className(), ['id' => 'pessoa_id']);
    }
}
