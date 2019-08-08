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
    const SCENARIO_REGISTRO_USUARIO = 'registro_aluno';
    const SCENARIO_REGISTRO_SERVIDOR = 'registro_servidor';

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
            [['matricula', 'nome'], 'string', 'max' => 45],
            [['matricula', 'nome'], 'required'],
            [['periodo_curso', 'faltas'], 'integer'],
            [['horario_treino', 'problema_saude'], 'string'],
            [['email', 'curso'], 'string', 'max' => 50],
            ['email', 'email'],
            [
                ['email', 'horario_treino'],
                'required',
                'on' => Pessoa::SCENARIO_REGISTRO_SERVIDOR
            ],
            [
                ['email', 'horario_treino', 'curso', 'periodo_curso'],
                'required',
                'on' => Pessoa::SCENARIO_REGISTRO_USUARIO
            ],
            [
                'espera',
                'boolean',
                'trueValue' => true,
                'falseValue' => false,
                'strict' => true
            ],
            [['telefone'], 'string', 'max' => 20],
            # Valores defautls
            ['problema_saude', 'default', 'value' => 'Nenhum problema de saúde.'],
            ['telefone', 'default', 'value' => 'Sem telefone.']
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios['registro_aluno'] = [
            'matricula',
            'nome',
            'email',
            'curso',
            'periodo_curso',
            'horario_treino',
            'problema_saude',
            'telefone',
            'espera'
        ];

        $scenarios['registro_servidor'] = [
            'matricula',
            'nome',
            'email',
            'horario_treino',
            'problema_saude',
            'telefone',
            'espera'
        ];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'matricula' => Yii::t('app', 'Matrícula'),
            'nome' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'Email'),
            'curso' => Yii::t('app', 'Curso'),
            'periodo_curso' => Yii::t('app', 'Período do Curso'),
            'horario_treino' => Yii::t('app', 'Horário do Treino'),
            'problema_saude' => Yii::t('app', 'Problema de Saúde'),
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
        return $this->hasMany(Treino::className(), ['id' => 'treino_id'])
            ->viaTable('pessoa_treino', ['pessoa_id' => 'id']);
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
        return $this->hasMany(Pessoa::className(), ['id' => 'instrutor_id'])
            ->viaTable('usuario_instrutor', ['usuario_id' => 'id']);
    }
}
