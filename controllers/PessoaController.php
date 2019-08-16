<?php

namespace app\controllers;

use Yii;
use app\models\Pessoa;
use app\models\PessoaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Deletes an existing Pessoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Criar um usuário aluno
     * @return string|\yii\web\Response
     */
    public function actionCreateAluno()
    {
        # Verificar se o usuário(instrutor) está autenticado.
        # Se o usuário estiver autenticado, então pegar a matrícula e
        # relacionar com o usuário comun(aluno) que será registrado.
        # Também verificar se o usuário tem permissão de acessar essa ação.

        $model = new Pessoa(['scenario' => Pessoa::SCENARIO_REGISTRO_USUARIO]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-aluno', 'id' => $model->id]);
        }

        return $this->render('aluno/create', [
            'model' => $model,
        ]);
    }

    /**
     * Cria um usuário servidor
     * @return string|\yii\web\Response
     */
    public function actionCreateServidor()
    {
        # Verificar se o usuário(instrutor) está autenticado.
        # Se o usuário estiver autenticado, então pegar a matrícula e
        # relacionar com o usuário comun(servidor) que será registrado.
        # Também verificar se o usuário tem permissão de acessar essa ação.

        $model = new Pessoa(['scenario' => Pessoa::SCENARIO_REGISTRO_SERVIDOR]);

        if ($model->load(Yii::$app->request->post())) {
            $model->servidor = true;
            if ($model->save()) {
                return $this->redirect(['view-servidor', 'id' => $model->id]);
            }
        }

        return $this->render('servidor/create', [
            'model' => $model,
        ]);
    }

    /**
     * Criar um usuário instrutor
     * @return string|\yii\web\Response
     */
    public function actionCreateInstrutor()
    {
        # Verificar se o usuário(admin) está autenticado.
        # Se o usuário estiver autenticado, então pegar a matrícula e
        # relacionar com o usuário instrutor que será registrado.
        # Também verificar se o usuário tem permissão de acessar essa ação.

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

    /**
     * Finds the Pessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
