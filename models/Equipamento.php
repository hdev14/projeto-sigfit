<?php

namespace app\models;

use Yii;
use DateTime;
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

    public static function tableName()
    {
        return 'equipamento';
    }

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

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome do Equipamento',
            'descricao' => 'Descrição do Equipamento',
            'imagem' => 'Imagem',
            'defeito' => 'Defeito',
            'image_file' => 'Adicionar Foto'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            if (!is_null($this->image_file)) {

                $timestamp = (new DateTime())->getTimestamp();

                $this->imagem = '/uploads/equipamentos/'
                    . $timestamp . '.' . $this->image_file->extension;

                $this->image_file->saveAs(
                    Yii::getAlias('@webroot') .
                    $this->imagem
                );

                $this->image_file = null;
            } else if (empty($this->imagem)) {
                $this->imagem = '/uploads/equipamentos/default.png';
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
