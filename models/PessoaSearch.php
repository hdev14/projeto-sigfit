<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['matricula', 'nome', 'email', 'curso', 'horario_treino', 'problema_saude', 'telefone'], 'safe'],
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

    public function searchUsuarios($instrutor_id)
    {
        // COLETA TODOS OS USUÁRIO DE ALUNOS E SERVIDORES QUE ESTÃO RELACIONADOS
        // COM O INSTRUTOR

        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios();

        return $query;
    }

    public function searchAlunos($instrutor_id)
    {
        // COLETA TODOS OS USUÁRIO DE ALUNOS QUE ESTA RELACIONADO COM O
        // INSTRUTOR

        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where(['servidor' => false]);

        return $query;
    }

    public function searchServidores($instrutor_id)
    {
        // COLETA TODOS OS USUÁRIO DE ALUNOS QUE ESTA RELACIONADO COM O
        // INSTRUTOR

        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where(['servidor' => true]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['nome' => SORT_ASC],
            ],
        ]);

        return $dataProvider;
    }

}
