<?php

namespace app\models;

use DateTime;
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
 * @property bool $espera
 * @property string $telefone
 * @property string $foto
 * @property bool $servidor
 * @property string $token
 * @property string $sexo
 *
 * @property Avaliacao[] $avaliacaos
 * @property Frequencia[] $frequencias
 * @property PessoaTreino[] $pessoaTreinos
 * @property Treino[] $treinos
 * @property UsuarioInstrutor[] $instrutorUsuarios
 * @property UsuarioInstrutor[] $usuarioInstrutores
 * @property Pessoa[] $usuarios
 * @property Pessoa[] $instrutors
 */
class Pessoa extends \yii\db\ActiveRecord implements IdentityInterface
{
    const SCENARIO_REGISTRO_USUARIO = 'registro_aluno';
    const SCENARIO_REGISTRO_SERVIDOR = 'registro_servidor';
    const SCENARIO_REGISTRO_INSTRUTOR = 'registro_instrutor';
    const QTD_FREQUENTADORES_POR_HORARIO = 8;
    CONST FALTAS_POR_MES = 3;

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
            [['horario_treino', 'problema_saude', 'foto', 'token', 'sexo'],
            'string'],
            [
                'espera',
                'boolean',
                'trueValue' => true,
                'falseValue' => false,
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
                ['email', 'horario_treino', 'sexo'],
                'required',
                'on' => Pessoa::SCENARIO_REGISTRO_SERVIDOR
            ],
            [
                ['email', 'horario_treino', 'curso', 'periodo_curso', 'sexo'],
                'required',
                'on' => Pessoa::SCENARIO_REGISTRO_USUARIO
            ],
            ['email', 'required', 'on' => Pessoa::SCENARIO_REGISTRO_INSTRUTOR],

            # VALIDADOR DE ARQUIVO PARA A FOTO
            [
                ['image_file'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => ['png', 'jpeg', 'jpg'],
                'maxSize' => 1024*1024
            ],

            # VALORES DEFAULT
            ['faltas', 'default', 'value' => 0],
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
            'sexo',
            'foto',
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
            'sexo',
            'foto',
            'image_file'
        ];

        $scenarios['registro_instrutor'] = [
            'matricula',
            'nome',
            'email',
            'foto',
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
            'id' => 'ID',
            'matricula' => 'Matrícula',
            'nome' => 'Nome',
            'email' => 'Email',
            'curso' => 'Curso',
            'periodo_curso' => 'Período do Curso',
            'horario_treino' => 'Horário do Treino',
            'problema_saude' => 'Problema de Saúde',
            'faltas' => 'Faltas',
            'espera' => 'Espera',
            'sexo' => 'Sexo',
            'telefone' => 'Telefone',
            'image_file' => 'Adicionar Foto',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord)
            $this->espera = $this->verificarHorarioDisponivel();

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->adicionarRoleInstrutor();

        parent::afterSave($insert, $changedAttributes);
    }

    public function upload()
    {
        if ($this->validate()) {
            if (!is_null($this->image_file)) {

                $timestamp = (new DateTime())->getTimestamp();

                $this->foto = '/uploads/usuarios/'
                    . $timestamp . '.' . $this->image_file->extension;

                $this->image_file->saveAs(
                    Yii::getAlias('@webroot') .
                    $this->foto
                );

                $this->image_file = null;
            } else if(empty($this->foto)) {
                $this->foto =  '/uploads/usuarios/default.jpeg';
            }
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
     * @throws \yii\base\InvalidConfigException
     */
    public function getTreinos()
    {
        return $this->hasMany(Treino::className(), ['id' => 'treino_id'])
            ->viaTable('pessoa_treino', ['pessoa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutorUsuarios()
    {
        return $this->hasMany(UsuarioInstrutor::className(), ['instrutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioInstrutores()
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

    public function verificarHorarioDisponivel()
    {
        $usuarios_com_mesmo_horario = Pessoa::find()->where(
            'horario_treino = :horario_treino',
            [':horario_treino' => $this->horario_treino]
        );

        $qtd_usuarios = $usuarios_com_mesmo_horario->count();

        if ($qtd_usuarios < Pessoa::QTD_FREQUENTADORES_POR_HORARIO)
            return false;

        return true;
    }

    protected function adicionarRoleInstrutor()
    {
        $auth = Yii::$app->authManager;

        if (!key_exists('instrutor', $auth->getRolesByUser($this->id))
            && $this->scenario === Pessoa::SCENARIO_REGISTRO_INSTRUTOR) {

            $instrutor_role = $auth->getRole('instrutor');
            $auth->assign($instrutor_role, $this->id);
        }
    }


}
