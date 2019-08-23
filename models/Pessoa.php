<?php

namespace app\models;

use Yii;

use yii\web\IdentityInterface;
use yii\web\UploadedFile;

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
 * @property string $foto
 * @property bool $servidor
 * @property string $token
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
class Pessoa extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_REGISTRO_USUARIO = 'registro_aluno';
    const SCENARIO_REGISTRO_SERVIDOR = 'registro_servidor';
    const SCENARIO_REGISTRO_INSTRUTOR = 'registro_instrutor';


    /** @var UploadedFile */
    public $image_file;

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
            ['matricula', 'unique'],
            ['matricula', 'number'],
            ['email', 'email'],
            [['email', 'curso'], 'string', 'max' => 50],
            [['periodo_curso', 'faltas'], 'integer'],
            [['horario_treino', 'problema_saude', 'foto', 'token'], 'string'],
            [
                'espera',
                'boolean',
                'trueValue' => true,
                'falseValue' => false,
                'strict' => true
            ],
            [['telefone'], 'string', 'max' => 20],
            [
                'servidor',
                'boolean',
                'trueValue' => true,
                'falseValue' => false,
                'strict' => false
            ],

            # SCENARIOS
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
            ['email', 'required', 'on' => Pessoa::SCENARIO_REGISTRO_INSTRUTOR],

            # VALIDADOR DE ARQUIVO PARA A FOTO
            [
                'image_file',
                'file','extensions' => ['png', 'jpeg', 'jpg'],
                'maxSize' => 1024*1024
            ],

            # VALORES DEFAULT
            ['problema_saude', 'default', 'value' => 'Nenhum problema de saúde.'],
            ['telefone', 'default', 'value' => 'Sem telefone.'],
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
            'espera',
            'image_file'
        ];

        $scenarios['registro_servidor'] = [
            'matricula',
            'nome',
            'email',
            'horario_treino',
            'problema_saude',
            'telefone',
            'espera',
            'image_file'
        ];

        $scenarios['registro_instrutor'] = [
            'matricula',
            'nome',
            'email',
            'image_file'
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
            'problema_saude' => Yii::t('app', 'Problema de Saúde (opcional)'),
            'faltas' => Yii::t('app', 'Faltas'),
            'espera' => Yii::t('app', 'Espera'),
            'telefone' => Yii::t('app', 'Telefone (opcional)'),
            'foto' => Yii::t('app', 'Adicionar Foto'),
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            # Antes de salvar o usuário verificar a variavel scenario.
            # Dessa forma, se a variavel for 'registro_aluno' deve-se adicionar
            # FALSE a coluna servidor, caso for 'registro_servidor', deve-se
            # colocar TRUE na coluna servidor.

        }
        return true;
    }

    /**
     * @return bool
     */
    public function upload()
    {

        if ($this->validate()) {
            $this->image_file->saveAs(
                'uploads/usuarios/' . $this->image_file->baseName .
                "." . $this->image_file->extension
            );
            return true;
        }
        return false;
    }


    public static function findByMatricula($matricula)
    {
        return static::findOne(['matricula' => $matricula]);
    }

    /**
     * @param int|string $id
     * @return Pessoa|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return Pessoa|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * @return int|string|void
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|void
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @param string $authKey
     * @return bool|void
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
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
    public function getUsuarioInstrutores()
    {
        return $this->hasMany(UsuarioInstrutor::className(), ['instrutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutorUsuarios()
    {
        return $this->hasMany(UsuarioInstrutor::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getUsuarios()
    {
        return $this->hasMany(Pessoa::className(), ['id' => 'usuario_id'])
            ->viaTable('usuario_instrutor', ['instrutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutores()
    {
        return $this->hasMany(Pessoa::className(), ['id' => 'instrutor_id'])
            ->viaTable('usuario_instrutor', ['usuario_id' => 'id']);
    }


}
