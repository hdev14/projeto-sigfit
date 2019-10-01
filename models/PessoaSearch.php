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

    /**
     * @param $instrutor_id
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function searchUsuarios($instrutor_id)
    {
        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios();
        return $query;
    }

    /**
     * @param $instrutor_id
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function searchAlunos($instrutor_id)
    {
        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where(['servidor' => false]);
        return $query;
    }

    /**
     * @param $instrutor_id
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function searchServidores($instrutor_id)
    {
        $instrutor = Pessoa::findOne($instrutor_id);
        $query = $instrutor->getUsuarios()->where(['servidor' => true]);
        return $query;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function searchInstrutores() {

        $query = Pessoa::find()->join(
            'INNER JOIN',
            'auth_assignment',
            "auth_assignment.user_id = pessoa.id AND auth_assignment.item_name = 'instrutor'"
        );

        return $query;
    }

}
