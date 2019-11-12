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

    public function searchInativos($instrutor_id, $dia, $horario_do_treino, $horario_string)
    {

        $ids_treinos_pessoas = $this->getIdsTreinosPessoas();
        Yii::debug($ids_treinos_pessoas->all(), 'IDS TREINOS');

        $ids_treinos_pessoas_dia_atual =
            $this->getIdsTreinosPessoasDiaAtual($ids_treinos_pessoas, $dia);
        Yii::debug($ids_treinos_pessoas_dia_atual->all(), 'IDS TREINOS DIA ATAUL');

        $id_usuarios_instruidos = $this->getUsuariosInstruidos($instrutor_id);
        Yii::debug($id_usuarios_instruidos->all(), 'USUARIOS INSTRUIDOS');

        $ids_usuarios_frequencia_dia_atual =
            $this->getUsuariosComFrequenciaDiaAtual($horario_do_treino);
        Yii::debug($ids_usuarios_frequencia_dia_atual->all(), 'IDS USUARIOS FREQUENCIA');

        $usuarios_inativos = $this->getUsuariosInativos(
            $ids_treinos_pessoas_dia_atual,
            $id_usuarios_instruidos,
            $ids_usuarios_frequencia_dia_atual,
            $horario_string
        );

        Yii::debug($usuarios_inativos->all(), 'USUARIO INATIVOS');

        return $usuarios_inativos;

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

    protected function getUsuariosInstruidos($instrutor_id)
    {
        return (new Query())->select('usuario_instrutor.usuario_id')->from('usuario_instrutor')
            ->where(['usuario_instrutor.instrutor_id' => $instrutor_id]);
    }

    protected function getUsuariosComFrequenciaDiaAtual($horario_do_treino)
    {
        return (new Query())->select('frequencia.pessoa_id')->from('frequencia')->where([
            'and', [
                'data' => date('Y-m-d')
            ], [
                'and',
                'time_to_sec(frequencia.horario_inicio) >= time_to_sec(:horario_inicio_treino)',
                'time_to_sec(frequencia.horario_inicio) < time_to_sec(:horario_fim_treino)'
            ]
        ])->addParams([
            'horario_inicio_treino' => $horario_do_treino[0],
            'horario_fim_treino' => $horario_do_treino[1]
        ]);
    }

    protected function getUsuariosInativos(
        $ids_treinos_pessoas_dia_atual,
        $id_usuarios_instruidos,
        $ids_usuarios_frequencia_dia_atual,
        $horario_string
    ) {

        return (new Query())->select('*')->from('pessoa')
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
