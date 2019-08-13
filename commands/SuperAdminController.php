<?php


namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;


class SuperAdminController extends  Controller
{
    public function actionCreate()
    {
        echo "Criado o admin \n";

        ExitCode::OK;
    }
}