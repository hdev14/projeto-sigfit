<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horario_treino".
 *
 * @property int $id
 * @property int $restricao_id
 * @property string $horario
 *
 * @property Restricao $restricao
 */
class HorarioTreino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario_treino';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['restricao_id', 'horario'], 'required'],
            [['restricao_id'], 'integer'],
            [['horario'], 'safe'],
            [['restricao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restricao::className(), 'targetAttribute' => ['restricao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'restricao_id' => Yii::t('app', 'Restricao ID'),
            'horario' => Yii::t('app', 'Horario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestricao()
    {
        return $this->hasOne(Restricao::className(), ['id' => 'restricao_id']);
    }
}
