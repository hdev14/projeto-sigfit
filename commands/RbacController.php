<?php


namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        # Define todas os papeis, como também todas permissões da aplicação.
        $auth = Yii::$app->authManager;

        $instrutor_perm = $auth->createPermission('crud-all');
        $instrutor_perm->description = "Pode realizar a manipulação de todoas as entidades do banco de dados.";
        $auth->add($instrutor_perm);

        $admin_perm = $auth->createPermission('crud-instrutor');
        $admin_perm->description = "Pode realizar o CRUD dos instrutores.";
        $auth->add($admin_perm);

        $super_admin_perm =  $auth->createPermission('super');
        $super_admin_perm->description = "Pode executar qualquer funcionalidade do sistema.";
        $auth->add($super_admin_perm);

        $instrutor_role =  $auth->createRole('instrutor');
        $auth->add($instrutor_role);
        $auth->addChild($instrutor_role, $instrutor_perm);

        $admin_role =  $auth->createRole('admin');
        $auth->add($admin_role);
        $auth->addChild($admin_role, $admin_perm);
        $auth->addChild($admin_role, $instrutor_role);

        $super_admin_role = $auth->createRole('super-admin');
        $auth->add($super_admin_role);
        $auth->addChild($super_admin_role, $super_admin_perm);
        $auth->addChild($super_admin_role, $admin_role);

    }

    public function actionVerificarPerm()
    {
        $auth = Yii::$app->authManager;

        $instrutor_role = $auth->getRole('instrutor');
        $admin_role = $auth->getRole('admin');
        $super_role = $auth->getRole('super-admin');

        if (!(is_null($instrutor_role) && is_null($admin_role) && is_null
            ($super_role))) {
            echo "Papeis e permissões adicionadas com sucesso ! \n";
            return;
        }

        echo "Não foram criadas as permissões.";
    }

    public function actionAddPermissaoSuper($id)
    {
        $auth = Yii::$app->authManager;
        $super_role = $auth->getRole('super-admin');
        $auth->assign($super_role, $id);

    }

    public function actionAddPermissaoAdmin($id)
    {
        $auth = Yii::$app->authManager;
        $admin_role = $auth->getRole('admin');
        $auth->assign($admin_role, $id);
    }

    public function actionAddPermissaoInstrutor($id)
    {
        $auth = Yii::$app->authManager;
        $instrutor_role = $auth->getRole('instrutor');
        $auth->assign($instrutor_role, $id);
    }
}