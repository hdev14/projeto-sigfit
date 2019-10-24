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
            [['dia', 'titulo', 'genero', 'nivel'], 'required'],
            [['dia', 'nivel'], 'string'],
            ['generico', 'boolean', 'trueValue' => true, 'falseValue' => false],
            [['titulo'], 'string', 'max' => 45],
            [['genero'], 'string', 'max' => 1],
            ['generico', 'default', 'value' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dia' => 'Dia recomendado',
            'generico' => 'Generico',
            'titulo' => 'Título',
            'genero' => 'Gênero',
            'nivel' => 'Nível',
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

    public function getTreinoExercicio($exercicio_id = null)
    {
        return $this->hasOne(TreinoExercicio::className(), ['treino_id' => 'id'])
            ->where('exercicio_id = :id', [':id' => $exercicio_id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['id' => 'exercicio_id'])->viaTable('treino_exercicio', ['treino_id' => 'id']);
    }
}
