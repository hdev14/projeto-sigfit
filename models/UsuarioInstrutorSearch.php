<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuarioInstrutor;

/**
 * UsuarioInstrutorSearch represents the model behind the search form of `app\models\UsuarioInstrutor`.
 */
class UsuarioInstrutorSearch extends UsuarioInstrutor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'instrutor_id'], 'integer'],
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
        $query = UsuarioInstrutor::find();

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
            'usuario_id' => $this->usuario_id,
            'instrutor_id' => $this->instrutor_id,
        ]);

        return $dataProvider;
    }

//    public function searchInstrutores()
//    {
//        $instrutores = UsuarioInstrutor::find()->join(
//                                    'INNER JOIN',
//                                    'pessoa',
//                                    'usuario_instrutor.instrutor_id = pessoa.id'
//                                    )->all();
//
//        foreach ($instrutores as $instrutor) {
//            Yii::trace($instrutor->, 'INSTRUTORES');
//        }
//
//    }

}
