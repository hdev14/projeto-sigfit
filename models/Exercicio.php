<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exercicio".
 *
 * @property int $id
 * @property int $equipamento_id
 * @property string $nome
 * @property string $descricao
 * @property string $tipo
 *
 * @property Equipamento $equipamento
 * @property TreinoExercicio[] $treinoExercicios
 * @property Treino[] $treinos
 */
class Exercicio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exercicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipamento_id'], 'integer'],
            [['nome', 'tipo'], 'required'],
            [['tipo'], 'string'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 200],
            [['equipamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipamento::className(), 'targetAttribute' => ['equipamento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipamento_id' => 'Equipamento (opcional)',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamento::className(), ['id' => 'equipamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreinoExercicios()
    {
        return $this->hasMany(TreinoExercicio::className(), ['exercicio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreinos()
    {
        return $this->hasMany(Treino::className(), ['id' => 'treino_id'])->viaTable('treino_exercicio', ['exercicio_id' => 'id']);
    }
}
