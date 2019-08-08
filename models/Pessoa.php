<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $id
 * @property string $matricula
 * @property string $nome
 * @property string $email
 * @property string $curso
 * @property int $periodo_curso
 * @property string $horario_treino
 * @property string $problema_saude
 * @property int $faltas
 * @property int $espera
 * @property string $telefone
 *
 * @property Avaliacao[] $avaliacaos
 * @property Frequencia[] $frequencias
 * @property PessoaTreino[] $pessoaTreinos
 * @property Treino[] $treinos
 * @property UsuarioInstrutor[] $usuarioInstrutors
 * @property UsuarioInstrutor[] $usuarioInstrutors0
 * @property Pessoa[] $usuarios
 * @property Pessoa[] $instrutors
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula', 'nome'], 'required'],
            [['periodo_curso', 'faltas', 'espera'], 'integer'],
            [['horario_treino', 'problema_saude'], 'string'],
            [['matricula', 'nome'], 'string', 'max' => 45],
            [['email', 'curso'], 'string', 'max' => 50],
            [['telefone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'matricula' => Yii::t('app', 'Matricula'),
            'nome' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'Email'),
            'curso' => Yii::t('app', 'Curso'),
            'periodo_curso' => Yii::t('app', 'Periodo Curso'),
            'horario_treino' => Yii::t('app', 'Horario Treino'),
            'problema_saude' => Yii::t('app', 'Problema Saude'),
            'faltas' => Yii::t('app', 'Faltas'),
            'espera' => Yii::t('app', 'Espera'),
            'telefone' => Yii::t('app', 'Telefone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaos()
    {
        return $this->hasMany(Avaliacao::className(), ['pessoa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrequencias()
    {
        return $this->hasMany(Frequencia::className(), ['pessoa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaTreinos()
    {
        return $this->hasMany(PessoaTreino::className(), ['pessoa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreinos()
    {
        return $this->hasMany(Treino::className(), ['id' => 'treino_id'])->viaTable('pessoa_treino', ['pessoa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioInstrutors()
    {
        return $this->hasMany(UsuarioInstrutor::className(), ['instrutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioInstrutors0()
    {
        return $this->hasMany(UsuarioInstrutor::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Pessoa::className(), ['id' => 'usuario_id'])->viaTable('usuario_instrutor', ['instrutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutors()
    {
        return $this->hasMany(Pessoa::className(), ['id' => 'instrutor_id'])->viaTable('usuario_instrutor', ['usuario_id' => 'id']);
    }
}
