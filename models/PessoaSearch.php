<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * PessoaSearch represents the model behind the search form of `app\models\Pessoa`.
 */
class PessoaSearch extends Pessoa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'periodo_curso', 'faltas', 'espera'], 'integer'],
            [['matricula', 'nome', 'email', 'curso', 'horario_treino', 'problema_saude', 'telefone', 'sexo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $aluno = false)
    {
        $query = Pessoa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'periodo_curso' => $this->periodo_curso,
            'faltas' => $this->faltas,
            'espera' => $this->espera,
        ]);

        $query->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'curso', $this->curso])
            ->andFilterWhere(['like', 'horario_treino', $this->horario_treino])
            ->andFilterWhere(['like', 'problema_saude', $this->problema_saude])
            ->andFilterWhere(['like', 'telefone', $this->telefone]);

        return $dataProvider;
    }

    public function searchUsuarios($instrutor_id, $espera)
    {
        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where('espera = :espera', [':espera' => $espera]);
        return $query;
    }

    public function searchAlunos($instrutor_id, $espera)
    {
        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where(
            ['and', 'servidor = 0', 'espera = :espera'],
            [':espera' => $espera]
        );
        return $query;
    }

    public function searchServidores($instrutor_id, $espera)
    {
        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where(
            ['and', 'servidor = 1', 'espera = :espera'],
            [':espera' => $espera]
        );
        return $query;
    }

    public function searchInstrutores() {

        $query = Pessoa::find()->join(
            'INNER JOIN',
            'auth_assignment',
            "auth_assignment.user_id = pessoa.id AND auth_assignment.item_name = 'instrutor'"
        );

        return $query;
    }

    public function searchAtivos($instrutor_id, $dia, $horario_do_treino, $horario_string)
    {
        $ids_treinos_pessoas = $this->getIdsTreinosPessoas();

        $ids_treinos_pessoas_dia_atual =
            $this->getIdsTreinosPessoasDiaAtual($ids_treinos_pessoas, $dia);

        $ids_usuarios_instruidos = $this->getIdsUsuariosInstruidos($instrutor_id);

        $ids_usuarios_frequencia_dia_atual =
            $this->getUsuariosComFrequenciaDiaAtual($horario_do_treino);

        $query_usuarios_ativos = $this->getUsuariosAtivos(
            $ids_treinos_pessoas_dia_atual,
            $ids_usuarios_instruidos,
            $ids_usuarios_frequencia_dia_atual,
            $horario_string
        );

        return $query_usuarios_ativos;
    }

    public function searchInativos($instrutor_id, $dia, $horario_do_treino, $horario_string)
    {
        $ids_treinos_pessoas = $this->getIdsTreinosPessoas();

        $ids_treinos_pessoas_dia_atual =
            $this->getIdsTreinosPessoasDiaAtual($ids_treinos_pessoas, $dia);

        $ids_usuarios_instruidos = $this->getIdsUsuariosInstruidos($instrutor_id);

        $ids_usuarios_frequencia_dia_atual =
            $this->getUsuariosComFrequenciaDiaAtual($horario_do_treino);

        $usuarios_inativos = $this->getUsuariosInativos(
            $ids_treinos_pessoas_dia_atual,
            $ids_usuarios_instruidos,
            $ids_usuarios_frequencia_dia_atual,
            $horario_string
        );

        return $usuarios_inativos;
    }

    public function searchUsuariosFaltosos($dia, $horario_do_treino)
    {
        $ids_pessoas_com_treino_dia_atual = $this->getPessoasComTreinoDiaAtual($dia);
        $ids_pessoas_com_frequencia_data_atual = $this->getPessoasComFrequenciaDataAtual();
        $pessoas_sem_frequencia = $this->getPessoasSemFrequencia(
            $ids_pessoas_com_treino_dia_atual,
            $horario_do_treino,
            $ids_pessoas_com_frequencia_data_atual
        );

        return $pessoas_sem_frequencia;
    }

    public function searchUsuariosSemCheckout($horario_de_treino)
    {
        $ids_pessoas_sem_registor_de_checkouts = (new Query())->select('frequencia.pessoa_id')
            ->from('frequencia')
            ->where([
                'and',
                ['data' => date('Y-m-d')],
                ['horario_final' => null]
            ]);

        $usuarios_sem_checkouts =  Pessoa::find()->where([
            'and',
            ['pessoa.id' => $ids_pessoas_sem_registor_de_checkouts],
            ['pessoa.horario_treino' => $horario_de_treino]
        ]);

        return $usuarios_sem_checkouts;
    }

    protected function getPessoasSemFrequencia(
        $ids_pessoas_com_treino_dia_atual,
        $horario_do_treino,
        $ids_pessoas_com_frequencia_data_atual
    ) {
        return Pessoa::find()
            ->where([
                'and', [
                    'pessoa.id' => $ids_pessoas_com_treino_dia_atual
                ], [
                    'pessoa.horario_treino' => $horario_do_treino
                ], [
                    'not in',
                    'pessoa.id',
                    $ids_pessoas_com_frequencia_data_atual
                ]
            ]);
    }

    protected function getPessoasComFrequenciaDataAtual()
    {
        return (new Query())->select('frequencia.pessoa_id')->from('frequencia')
            ->where(['frequencia.data' => date('Y-m-d')]);
    }

    protected function getPessoasComTreinoDiaAtual($dia)
    {
        return (new Query())->select('pessoa_treino.pessoa_id')->from('treino')
            ->innerJoin('pessoa_treino', 'treino.id = pessoa_treino.treino_id')
            ->where(['treino.dia' => $dia]);
    }

    protected function getIdsTreinosPessoas()
    {
        return (new Query())->select('pessoa_treino.treino_id')->from('pessoa')
            ->innerJoin('pessoa_treino', 'pessoa.id = pessoa_treino.pessoa_id');
    }

    protected function getIdsTreinosPessoasDiaAtual($ids_treinos_pessoas, $dia)
    {
        return (new Query())->select('treino.id')->from('treino')->where([
            'and',
            ['treino.id' =>  $ids_treinos_pessoas],
            ['treino.dia' => $dia]
        ]);
    }

    protected function getIdsUsuariosInstruidos($instrutor_id)
    {
        return (new Query())->select('usuario_instrutor.usuario_id')->from('usuario_instrutor')
            ->where(['usuario_instrutor.instrutor_id' => $instrutor_id]);
    }

    protected function getUsuariosComFrequenciaDiaAtual($horario_do_treino)
    {
        return (new Query())->select('frequencia.pessoa_id')
            ->from('frequencia')
            ->where(['data' => date('Y-m-d')]);
    }

    protected function getUsuariosAtivos(
        $ids_treinos_pessoas_dia_atual,
        $id_usuarios_instruidos,
        $ids_usuarios_frequencia_dia_atual,
        $horario_string
    ) {
        return Pessoa::find()
            ->innerJoin('pessoa_treino', 'pessoa.id = pessoa_treino.pessoa_id')
            ->where([
                'and',
                ['pessoa_treino.treino_id' => $ids_treinos_pessoas_dia_atual],
                ['pessoa.id' => $id_usuarios_instruidos],
                ['in', 'pessoa.id', $ids_usuarios_frequencia_dia_atual],
                ['pessoa.horario_treino' => $horario_string]
            ]);
    }

    protected function getUsuariosInativos(
        $ids_treinos_pessoas_dia_atual,
        $id_usuarios_instruidos,
        $ids_usuarios_frequencia_dia_atual,
        $horario_string
    ) {
        return Pessoa::find()
            ->innerJoin('pessoa_treino', 'pessoa.id = pessoa_treino.pessoa_id')
            ->where([
                'and',
                ['pessoa_treino.treino_id' => $ids_treinos_pessoas_dia_atual],
                ['pessoa.id' => $id_usuarios_instruidos],
                ['not in', 'pessoa.id', $ids_usuarios_frequencia_dia_atual],
                ['pessoa.horario_treino' => $horario_string]
            ]);
    }
}
