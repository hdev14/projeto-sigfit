<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "treino".
 *
 * @property int $id
 * @property string $dia
 * @property int $generico
 * @property string $titulo
 * @property string $genero
 * @property string $nivel
 *
 * @property PessoaTreino[] $pessoaTreinos
 * @property Pessoa[] $pessoas
 * @property TreinoExercicio[] $treinoExercicios
 * @property Exercicio[] $exercicios
 */
class Treino extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treino';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dia', 'titulo', 'genero'], 'required'],
            [['dia', 'nivel'], 'string'],
            [['generico'], 'integer'],
            [['titulo'], 'string', 'max' => 45],
            [['genero'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dia' => Yii::t('app', 'Dia'),
            'generico' => Yii::t('app', 'Generico'),
            'titulo' => Yii::t('app', 'Titulo'),
            'genero' => Yii::t('app', 'Genero'),
            'nivel' => Yii::t('app', 'Nivel'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaTreinos()
    {
        return $this->hasMany(PessoaTreino::className(), ['treino_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoas()
    {
        return $this->hasMany(Pessoa::className(), ['id' => 'pessoa_id'])->viaTable('pessoa_treino', ['treino_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreinoExercicios()
    {
        return $this->hasMany(TreinoExercicio::className(), ['treino_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['id' => 'exercicio_id'])->viaTable('treino_exercicio', ['treino_id' => 'id']);
    }
}
