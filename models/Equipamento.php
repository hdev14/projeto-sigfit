<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
    /** @var UploadedFile */
    public $image_file;

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
            [
                ['image_file'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => ['png', 'jpeg', 'jpg'],
                'maxSize' => 1024*1024
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome do Equipamento',
            'descricao' => 'Descrição do Equipamento',
            'imagem' => 'Imagem',
            'defeito' => 'Defeito',
        ];
    }


    public function upload()
    {
        if (!$this->validate()) {

            if (!is_null($this->image_file)) {
                // TODO Implemente o upload da imagem.
            } else if (empty($this->imagem)) {
                $this->imagem = ''; // TODO colocar imagem padrão.
            }

            return true;
        }

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['equipamento_id' => 'id']);
    }
}
