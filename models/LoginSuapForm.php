<?php


namespace app\models;


use yii\base\Model;

class LoginSuapForm extends Model
{
    public $matricula;
    public $senha;

    public function rules()
    {
        return [
            [['matricula', 'senha'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'matricula' => 'Matrícula',
            'senha' => 'Senha'
        ];
    }
}