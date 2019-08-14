<?php


namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Pessoa;

class SuperAdminController extends  Controller
{
    public function actionIndex()
    {
        echo "Actions: \n";
        echo "super-admin/create - Cria um usuário administrador.\n";
        echo "super-admin/perms - Define as regras e permissões do sistema. \n";
    }

    public function actionPerms()
    {

    }

    public function actionCreate($matricula, $nome, $email)
    {
        echo "Criar administrador\n";
        ExitCode::OK;
    }
}