<?php


namespace app\filters;


use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;
use app\models\Pessoa;

class AuthSuap extends ActionFilter
{

    public function beforeAction($action)
    {
        /** @var $suap \app\components\Suap */
        $suap = Yii::$app->suap;

        $usuario_id = Yii::$app->user->getId();
        $usuario = Pessoa::findOne($usuario_id);
        $token = Yii::$app->session->get('token', null);

        if (!(($usuario !== null) && ($usuario->token === $token[0]))) {
            throw new ForbiddenHttpException("Você não tem permissão de acessar está página.");
        }

        return parent::beforeAction($action);
    }
}