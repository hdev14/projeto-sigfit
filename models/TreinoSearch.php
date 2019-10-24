<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Treino;

/**
 * TreinoSearch represents the model behind the search form of `app\models\Treino`.
 */
class TreinoSearch extends Treino
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'generico'], 'integer'],
            [['dia', 'titulo', 'genero', 'nivel'], 'safe'],
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
    public function search($params)
    {
        $query = Treino::find();

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
            'generico' => $this->generico,
        ]);

        $query->andFilterWhere(['like', 'dia', $this->dia])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'genero', $this->genero])
            ->andFilterWhere(['like', 'nivel', $this->nivel]);

        return $dataProvider;
    }
}
