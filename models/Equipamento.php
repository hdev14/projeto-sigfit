<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipamento".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $imagem
 * @property int $defeito
 *
 * @property Exercicio[] $exercicios
 */
class Equipamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['imagem'], 'string'],
            [['defeito'], 'integer'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'descricao' => Yii::t('app', 'Descricao'),
            'imagem' => Yii::t('app', 'Imagem'),
            'defeito' => Yii::t('app', 'Defeito'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['equipamento_id' => 'id']);
    }
}
