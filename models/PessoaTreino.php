<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa_treino".
 *
 * @property int $treino_id
 * @property int $pessoa_id
 *
 * @property Pessoa $pessoa
 * @property Treino $treino
 */
class PessoaTreino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa_treino';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['treino_id', 'pessoa_id'], 'required'],
            [['treino_id', 'pessoa_id'], 'integer'],
            [['treino_id', 'pessoa_id'], 'unique', 'targetAttribute' => ['treino_id', 'pessoa_id']],
            [['pessoa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['pessoa_id' => 'id']],
            [['treino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Treino::className(), 'targetAttribute' => ['treino_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'treino_id' => Yii::t('app', 'Treino ID'),
            'pessoa_id' => Yii::t('app', 'Pessoa ID'),
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
    public function getTreino()
    {
        return $this->hasOne(Treino::className(), ['id' => 'treino_id']);
    }
}
