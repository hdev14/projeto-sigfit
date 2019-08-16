<?php


namespace app\commands;

use yii\console\Controller;
use app\models\Pessoa;
use \Exception;

class SuperAdminController extends  Controller
{
    public function actionIndex()
    {
        echo "---- AÇÕES ---- \n";
        echo "super-admin/admins - Retorna todos os administradores. \n";
        echo "super-admin/create-admin - Cria um usuário administrador.\n";
        echo "super-admin/update-admin - Editar um usuário administrador. \n";
        echo "super-admin/delete-admin - Excluir um usuário administrador. \n";
        echo "super-admin/view-admin - Retorna os dados de um aministrador. \n";
    }

    public function actionCreateAdmin($matricula, $nome, $email)
    {
        # DEPOIS QUE A AUTENTICAÇÃO ESTIVE COMPLETADA, VERIFICAR SE
        # O USUÁRIO ESTA AUTENTICA E SE TEM PERMISSÃO PARA EXECUTAR ESTA AÇÃO,
        # DEPOIS RELACIONAR O USUÁRIO AUTENTICADO COM O NOVO ADMINISTRADOR.

        $admin = new Pessoa();
        $admin->matricula = $matricula;
        $admin->nome = $nome;
        $admin->email = $email;

        if ($admin->save()) {
            echo "Registro feito com sucesso. \n";
            return;
        }

        echo "Não foi possível criar um administrador. \n";
    }

    public function actionUpdateAdmin(
        $id,
        $matricula = null,
        $nome = null,
        $email = null
    ) {
        # DEPOIS QUE A AUTENTICAÇÃO ESTIVE COMPLETADA, VERIFICAR SE
        # O USUÁRIO ESTA AUTENTICA E SE TEM PERMISSÃO PARA EXECUTAR ESTA AÇÃO.

        try {
            $admin = $this->findModel($id);
            $admin->matricula =
                is_null($matricula) ? $admin->matricula : $matricula;
            $admin->nome = is_null($nome) ? $admin->nome : $nome;
            $admin->email = is_null($email) ? $admin->email : $email;

            if ($admin->save()) {
                echo "Administrador Atualizado.\n";
                return;
            }

            echo "Não foi possível editar o administrador. Por favor, tente novamente.\n";

        } catch (Exception $e) {
            echo $e->getMessage() . " - " . $e->getLine() . "\n";
        }
    }

    public function actionDeleteAdmin($id)
    {
        # DEPOIS QUE A AUTENTICAÇÃO ESTIVE COMPLETADA, VERIFICAR SE
        # O USUÁRIO ESTA AUTENTICA E SE TEM PERMISSÃO PARA EXECUTAR ESTA AÇÃO.

        try {
            $admin = $this->findModel($id);
            if ($admin->delete()) {
                echo "Administrador excluído com sucesso.\n";
                return;
            }

            echo "Não foi possível excluir o administrador. Por favor, tente novamente.\n";

        } catch (Exception $e) {
            echo $e->getMessage() . " - " . $e->getLine() . "\n";
        }
    }

    public function actionViewAdmin($id)
    {
        try {

            $admin = $this->findModel($id);

            echo "---- ADMINISTRADOR ----\n";
            echo "MATRÍCULA: " . $admin->matricula . "\n";
            echo "NOME: " . $admin->nome . "\n";
            echo "EMAIL: " . $admin->email . "\n";

            return;

        } catch (Exception $e) {
            echo $e->getMessage() . " - " . $e->getLine() . "\n";
        }
    }

    protected function findModel($id) {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        }
        throw new Exception("Admin não encontrado");
    }
}