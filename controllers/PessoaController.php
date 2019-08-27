<?php

namespace app\controllers;

use app\models\UsuarioInstrutor;
use Yii;
use app\models\Pessoa;
use app\models\PessoaSearch;
use yii\data\Pagination;
use yii\db\QueryInterface;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
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
            /*
            'access' => [
                [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            REGRA PARA O USUÁRIO QUE TEM PERMISSÃO DE INSTRUTOR
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
                            'roles' => ['@'],
                            'permissions' => ['crud-all'],
                        ],
                        [
                            REGRA PARA USUÁRIO QUE TEM PERMISSÃO DE ADMIN
                            'allow' => true,
                            'actions' => [
                                'create-instrutor',
                                'update-instrutor',
                                'view-instrutor',
                            ],
                            'roles' => ['@'],
                            'permissions' => ['crud-all', 'crud-instrutor'],
                        ],

                        [   REGRA PARA USUÁRIO QUE TEM PERMISSÃO DE SUPER-ADMIN
                            'allow' => true,
                            'roles' => ['@'],
                            'permissions' => ['super']
                        ],
                    ],
                ],
            ], */
        ];
    }

    /**
     * Lists all Pessoa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PessoaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pessoa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Creates a new Pessoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
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

    /**
     * Updates an existing Pessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->servidor) {
            return $this->render('servidor/update', [
                'model' => $model
            ]);
        }

        return $this->render('aluno/update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Lista todos os usuários Alunos e Servidores
     * @return string
     */
    public function actionUsuarios()
    {
        $pessoa_search = new PessoaSearch();
        /** @var $query QueryInterface */
        $query = $pessoa_search->searchUsuarios(Yii::$app->user->getId());

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $usuarios = $this->paginar($query, $pagination);

        return $this->render('usuarios', [
            'usuarios' => $usuarios,
            'pagination' => $pagination,
        ]);
    }

    # ---- ALUNO ---- #

    /**
     * Lista todos os Alunos
     * @return string
     */
    public function actionAlunos()
    {
        $pessoa_search = new PessoaSearch();
        /** @var $query QueryInterface */
        $query = $pessoa_search->searchAlunos(Yii::$app->user->getId());

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $alunos = $this->paginar($query, $pagination);

        return $this->render('aluno/alunos', [
            'alunos' => $alunos,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Criar um usuário aluno
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreateAluno()
    {
        $usuario_model = new Pessoa([
            'scenario' => Pessoa::SCENARIO_REGISTRO_USUARIO
        ]);

        $post = Yii::$app->request->post();

        if ($usuario_model->load($post)) {
            $usuario_model->image_file = UploadedFile::getInstance($usuario_model, 'image_file');
            if ($usuario_model->upload()
                && $usuario_model->save()
                && $this->relacionarUsuarioInstrutor($usuario_model)) {
                return $this->redirect(['view', 'id' => $usuario_model->id]);
            }
        }

        return $this->render('aluno/create', [
            'model' => $usuario_model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    protected function updateAluno($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Pessoa::SCENARIO_REGISTRO_USUARIO;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-aluno', 'id' => $model->id]);
        }

        return $this->render('aluno/update', [
            'model' => $model,
        ]);
    }

    # ---- SERVIDOR ---- #

    /**
     * Lista todos os servidores
     * @return string
     */
    public function actionServidores()
    {
        $pessoa_search = new PessoaSearch();
        /** @var $query QueryInterface */
        $query = $pessoa_search->searchServidores(Yii::$app->user->getId());

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $servidores = $this->paginar($query, $pagination);

        return $this->render('servidor/servidores', [
            'servidores' => $servidores,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Cria um usuário servidor
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreateServidor()
    {
        $usuario_model = new Pessoa([
            'scenario' => Pessoa::SCENARIO_REGISTRO_SERVIDOR
        ]);

        $post = Yii::$app->request->post();

        if ($usuario_model->load($post)) {
            $usuario_model->servidor = true;
            $usuario_model->image_file = UploadedFile::getInstance($usuario_model, 'image_file');
            if ($usuario_model->upload()
                && $usuario_model->save()
                && $this->relacionarUsuarioInstrutor($usuario_model)) {
                return $this->redirect(['view', 'id' => $usuario_model->id]);
            }
        }

        return $this->render('servidor/create', [
            'model' => $usuario_model,
        ]);
    }

    /**
     * Edita um servidor
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    protected function updateServidor($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Pessoa::SCENARIO_REGISTRO_SERVIDOR;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-servidor', 'id' => $model->id]);
        }

        return $this->render('servidor/update', [
            'model' => $model,
        ]);
    }

    # ---- INSTRUTOR ---- #

    /**
     * Criar um usuário instrutor
     * @return string|\yii\web\Response
     */
    public function actionCreateInstrutor()
    {
        $model = new Pessoa([
            'scenario' => Pessoa::SCENARIO_REGISTRO_INSTRUTOR
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-instrutor', 'id' => $model->id]);
        }

        return $this->render('instrutor/create', [
            'model' => $model,
        ]);
    }

    /**
     * Edita um usuário instrutor
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateInstrutor($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Pessoa::SCENARIO_REGISTRO_INSTRUTOR;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-instrutor', 'id' => $model->id]);
        }

        return $this->render('instrutor/update', [
            'model' => $model,
        ]);
    }

    /**
     * Visão de um Instrutor
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewInstrutor($id)
    {
        return $this->render('instrutor/view', [
            'model' => $this->findModel($id),
        ]);
    }


    # ---- MÉTODOS AUXILIARES ---- #

    /**
     * @param $usuario_model \app\models\Pessoa
     * @return bool
     * @throws NotFoundHttpException
     */
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

    /**
     * @param $id
     * @return Pessoa|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected  function paginar(QueryInterface $query , Pagination $p)
    {
        return $query->orderBy('nome')->offset($p->offset)->limit($p->limit)
            ->all();
    }

}
