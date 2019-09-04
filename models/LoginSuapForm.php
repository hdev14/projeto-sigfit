<?php


namespace app\models;


use Yii;
use yii\base\Model;

class LoginSuapForm extends Model
{
    public $matricula;
    public $senha;

    public function rules()
    {
        return [
            [['matricula', 'senha'], 'required'],
            ['matricula', 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'matricula' => 'Matrícula',
            'senha' => 'Senha'
        ];
    }

    public function login($token)
    {
        return Yii::$app->user->loginByAccessToken($token);
    }

    public function autenticarUsuario()
    {
        return Yii::$app->suap->autenticar($this->matricula, $this->senha);
    }
}