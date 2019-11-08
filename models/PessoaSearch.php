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

    public function searchInativos($instrutor_id, $dia)
    {
        $ids_treinos_pessoas = $this->getIdsTreinosPessoas();
        $ids_treinos_do_dia_atual = $this->getIdsTreinosDiaAtual($ids_treinos_pessoas, $dia);
        $usuarios_com_treinos_no_dia_atual = $this->getUsuariosComTreinoDiaAtual(
            $instrutor_id,
            $ids_treinos_do_dia_atual
        );

        return $usuarios_com_treinos_no_dia_atual;

    }

    protected function getIdsTreinosPessoas()
    {
        return (new Query())->select('pt.treino_id')
                            ->from('pessoa as p')
                            ->innerJoin('pessoa_treino as pt', 'p.id = pt.pessoa_id')
                            ->where('');
    }

    protected function getIdsTreinosDiaAtual($ids_treinos_pessoas, $dia)
    {
        return (new Query())->select('id')
                            ->from('treino')
                            ->where(['id' => $ids_treinos_pessoas])
                            ->andWhere(['dia' => $dia]);
    }

    protected function getUsuariosComTreinoDiaAtual($instrutor_id, $ids_treinos_do_dia_atual)
    {
        return Pessoa::findOne($instrutor_id)->getUsuarios()
                        ->innerJoin('pessoa_treino as pt', 'id = pt.pessoa_id')
                        ->where(['pt.treino_id' => $ids_treinos_do_dia_atual]);
    }

}
