<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "treino_exercicio".
 *
 * @property int $treino_id
 * @property int $exercicio_id
 * @property string $numero_repeticao
 *
 * @property Exercicio $exercicio
 * @property Treino $treino
 */
class TreinoExercicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treino_exercicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['treino_id', 'exercicio_id', 'numero_repeticao'], 'required'],
            [['treino_id', 'exercicio_id'], 'integer'],
            [['numero_repeticao'], 'string'],
            [['treino_id', 'exercicio_id'], 'unique', 'targetAttribute' => ['treino_id', 'exercicio_id']],
            [['exercicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicio::className(), 'targetAttribute' => ['exercicio_id' => 'id']],
            [['treino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Treino::className(), 'targetAttribute' => ['treino_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'treino_id' => 'Treino ID',
            'exercicio_id' => 'Exercicio ID',
            'numero_repeticao' => 'Número de repetições',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio()
    {
        return $this->hasOne(Exercicio::className(), ['id' => 'exercicio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreino()
    {
        return $this->hasOne(Treino::className(), ['id' => 'treino_id']);
    }
}
