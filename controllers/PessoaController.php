<?php

namespace app\controllers;

use app\models\UsuarioInstrutor;
use Yii;
use app\models\Pessoa;
use app\models\PessoaSearch;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\QueryInterface;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\filters\AuthSuap;
use yii\web\UploadedFile;

/**
 * PessoaController implements the CRUD actions for Pessoa model.
 */
class PessoaController extends Controller
{
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'auth-suap' => [
                /* VERIFICA SE O USUÁRIO ESTÀ AUTENTICADO */
                'class' => AuthSuap::className(),
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [   #REGRA PARA O USUÁRIO QUE TEM PERMISSÃO DE INSTRUTOR
                        'allow' => true,
                        'actions' => [
                            'index',
                            'view',
                            'create',
                            'update',
                            'delete',
                            'usuarios',
                            'alunos',
                            'create-aluno',
                            'servidores',
                            'create-servidor',
                        ],
                        'roles' => ['crud-all'],
                    ],
                    [   #REGRA PARA USUÁRIO QUE TEM PERMISSÃO DE ADMIN
                        'allow' => true,
                        'actions' => [
                            'instrutores',
                            'create-instrutor',
                            'update-instrutor',
                            'view-instrutor',
                        ],
                        'roles' => ['crud-instrutor'],
                    ],

                    [   #REGRA PARA USUÁRIO QUE TEM PERMISSÃO DE SUPER-ADMIN
                        'allow' => true,
                        'roles' => ['super'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new PessoaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->servidor) {
            return $this->render('servidor/view', [ 'model' => $model]);
        }

        return $this->render('aluno/view', [
            'model' => $model,
        ]);

    }

    public function actionCreate()
    {
        $model = new Pessoa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->servidor) {
            return $this->updateServidor($model);
        }

        return $this->updateAluno($model);
    }

    public function actionDelete($id)
    {
        $usuario = $this->findModel($id);

        $this->excluirRelacionamentos($usuario);

        $session = Yii::$app->session;

        if ($usuario->delete())
            $session->addFlash('success', 'Usuário excluído com sucesso !');
        else
            $session->addFlash('error', 'Não foi possível excluir o usuário.');

        return $this->redirect(['usuarios']);
    }

    public function actionUsuarios($espera = false)
    {
        $pessoa_search = new PessoaSearch();
        /** @var $query QueryInterface */
        $query = $pessoa_search->searchUsuarios(Yii::$app->user->getId(), $espera);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $usuarios = $this->paginar($query, $pagination);

        return $this->render('usuarios', [
            'usuarios' => $usuarios,
            'pagination' => $pagination,
            'espera' => $espera
        ]);
    }

    # ---- ALUNO ---- #

    public function actionAlunos($espera = false)
    {
        $pessoa_search = new PessoaSearch();
        /** @var $query QueryInterface */
        $query = $pessoa_search->searchAlunos(Yii::$app->user->getId(), $espera);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $alunos = $this->paginar($query, $pagination);

        return $this->render('aluno/alunos', [
            'alunos' => $alunos,
            'pagination' => $pagination,
            'espera' => $espera
        ]);
    }

    public function actionCreateAluno()
    {
        $usuario_model = new Pessoa([
            'scenario' => Pessoa::SCENARIO_REGISTRO_USUARIO
        ]);

        $post = Yii::$app->request->post();
        $session =  Yii::$app->session;

        if ($usuario_model->load($post)) {
            $usuario_model->image_file = UploadedFile::getInstance($usuario_model, 'image_file');
            if ($usuario_model->upload() && $usuario_model->save()
                && $this->relacionarUsuarioInstrutor($usuario_model)) {

                $mensagem = $usuario_model->espera ?
                    'Usuário registrado, porém está na fila de espera.' :
                    'Usuário registrado com sucesso !';
                $session->addFlash('success', $mensagem);

                return $this->redirect(['view', 'id' => $usuario_model->id]);
            } else {
                $session->addFlash('error', 'Não foi possível registrar o usuário.');
            }
        }

        return $this->render('aluno/create', [
            'model' => $usuario_model,
        ]);
    }

    # ---- SERVIDOR ---- #

    public function actionServidores($espera = false)
    {
        $pessoa_search = new PessoaSearch();
        /** @var $query QueryInterface */
        $query = $pessoa_search->searchServidores(Yii::$app->user->getId(), $espera);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $servidores = $this->paginar($query, $pagination);

        Yii::debug($servidores);

        return $this->render('servidor/servidores', [
            'servidores' => $servidores,
            'pagination' => $pagination,
            'espera' => $espera
        ]);
    }

    public function actionCreateServidor()
    {
        $usuario_model = new Pessoa([
            'scenario' => Pessoa::SCENARIO_REGISTRO_SERVIDOR
        ]);

        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($usuario_model->load($post)) {
            $usuario_model->servidor = true;
            $usuario_model->image_file = UploadedFile::getInstance($usuario_model, 'image_file');
            if ($usuario_model->upload() && $usuario_model->save()
                && $this->relacionarUsuarioInstrutor($usuario_model)) {
                $session->addFlash('success', 'Usuário registrado com sucesso !');
                return $this->redirect(['view', 'id' => $usuario_model->id]);
            } else {
                $session->addFlash('error', 'Não foi possível registra o usuário.');
            }
        }

        return $this->render('servidor/create', [
            'model' => $usuario_model,
        ]);
    }

    # ---- INSTRUTOR ---- #

    public function actionInstrutores()
    {
        $pessoa_search = new PessoaSearch();
        $query = $pessoa_search->searchInstrutores();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $instrutores = $this->paginar($query, $pagination);

        return $this->render('instrutor/instrutores', [
            'instrutores' => $instrutores,
            'pagination' => $pagination,
        ]);
    }

    public function actionCreateInstrutor()
    {
        $model = new Pessoa([
            'scenario' => Pessoa::SCENARIO_REGISTRO_INSTRUTOR
        ]);

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            if ($model->upload() && $model->save()) {
                return $this->redirect(['view-instrutor', 'id' => $model->id]);
            }
        }

        return $this->render('instrutor/create', [
            'model' => $model,
        ]);
    }

    public function actionUpdateInstrutor($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Pessoa::SCENARIO_REGISTRO_INSTRUTOR;
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            if ($model->upload() && $model->save()) {
                return $this->redirect(['view-instrutor', 'id' => $model->id]);
            }
        }

        return $this->render('instrutor/update', [
            'model' => $model,
        ]);
    }

    public function actionViewInstrutor($id)
    {
        $instrutor_model = $this->findModel($id);

        $query = $instrutor_model->getUsuarios();

        $data_provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('instrutor/view', [
            'model' => $instrutor_model,
            'data_provider' => $data_provider,
        ]);
    }

    public function actionDeleteInstrutor($id)
    {
        $instrutor_model = $this->findModel($id);
        $instrutor_usuarios = $instrutor_model->instrutorUsuarios;

        # Exclui os registros na tabela de relacionamento.
        foreach ($instrutor_usuarios as $iu) {
            $iu->delete();
        }

        $instrutor_model->delete();

        return $this->redirect(['instrutores']);
    }

    // TODO Fazer ação para retirar o usuário da fila de espera.

    # ---- MÉTODOS AUXILIARES ---- #

    protected function updateAluno(Pessoa $model)
    {
        $model->scenario = Pessoa::SCENARIO_REGISTRO_USUARIO;
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($model->load($post)) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            if ($model->upload() && $model->save()) {
                $session->addFlash('success', 'Usuário atualizado com sucesso !');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $session->addFlash('error', "Não foi possível atualizar o usuário.");
            }
        }

        return $this->render('aluno/update', [
            'model' => $model,
        ]);
    }

    protected function updateServidor(Pessoa $model)
    {
        $model->scenario = Pessoa::SCENARIO_REGISTRO_SERVIDOR;
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($model->load($post)) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            if ($model->upload() && $model->save()) {
                $session->addFlash('success', 'Usuário atualizado com sucesso !');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $session->addFlash('error', 'Não foi possível atualizar o usuário.');
            }
        }

        return $this->render('servidor/update', [
            'model' => $model,
        ]);
    }

    protected function relacionarUsuarioInstrutor($usuario_model)
    {
        $instrutor = $this->findModel(Yii::$app->user->getId());
        $usuario_instrutor_model = new UsuarioInstrutor();
        $usuario_instrutor_model->usuario_id = $usuario_model->id;
        $usuario_instrutor_model->instrutor_id = $instrutor->id;

        if ($usuario_instrutor_model->save())
            return true;

        return false;

    }

    protected function excluirRelacionamentos(Pessoa $usuario)
    {
        $usuario_instrutores = $usuario->usuarioInstrutores;
        $usuario_treinos = $usuario->pessoaTreinos;
        $usuario_avalicoes = $usuario->avaliacaos;

        foreach ($usuario_instrutores as $ui)
            $ui->delete();

        foreach ($usuario_treinos as $ut)
            $ut->delete();

        foreach ($usuario_avalicoes as $ua)
            $ua->delete();
    }

    protected function paginar(QueryInterface $query , Pagination $p)
    {
        return $query->orderBy('nome')->offset($p->offset)->limit($p->limit)->all();
    }

    protected function findModel($id)
    {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
