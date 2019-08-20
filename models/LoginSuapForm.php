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
        ];
    }

    public function attributeLabels()
    {
        return [
            'matricula' => 'Matrícula',
            'senha' => 'Senha'
        ];
    }

    public function login()
    {
        return Yii::$app->user->loginByAccessToken();
    }

    public function autenticarUser()
    {
        return Yii::$app->suap->autenticar($this->matricula, $this->senha);
    }
}