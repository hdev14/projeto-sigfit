<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restricao".
 *
 * @property int $id
 * @property int $numero_faltas
 * @property int $numero_usuarios
 * @property int $ativado
 *
 * @property HorarioTreino[] $horarioTreinos
 */
class Restricao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restricao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero_faltas', 'numero_usuarios', 'ativado'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_faltas' => Yii::t('app', 'Numero Faltas'),
            'numero_usuarios' => Yii::t('app', 'Numero Usuarios'),
            'ativado' => Yii::t('app', 'Ativado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioTreinos()
    {
        return $this->hasMany(HorarioTreino::className(), ['restricao_id' => 'id']);
    }
}
