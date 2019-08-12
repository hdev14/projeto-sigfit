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

    #### Create, Read e Update para Usuários Alunos. ####

    public function actionCreateAluno()
    {
        # Verificar se o usuário(instrutor) está autenticado.
        # Se o usuário estiver autenticado, então pegar a matrícula e
        # relacionar com o usuário comun(aluno) que será registrado.

        $model = new Pessoa(['scenario' => Pessoa::SCENARIO_REGISTRO_USUARIO]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-aluno', 'id' => $model->id]);
        }

        return $this->render('aluno/create', [
            'model' => $model,
        ]);
    }

    public function actionUpdateAluno($id)
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

    public function actionViewAluno($id)
    {
        return $this->render('aluno/view', [
            'model' => $this->findModel($id),
        ]);
    }

    # ------------------------------------------------------ #

    #### Create, Read e Update para Usuários Servidores. ####

    public function actionCreateServidor()
    {
        # Verificar se o usuário(instrutor) está autenticado.
        # Se o usuário estiver autenticado, então pegar a matrícula e
        # relacionar com o usuário comun(servidor) que será registrado.

        $model = new Pessoa(['scenario' => Pessoa::SCENARIO_REGISTRO_SERVIDOR]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-servidor', 'id' => $model->id]);
        }

        return $this->render('servidor/create', [
            'model' => $model,
        ]);
    }

    public function actionUpdateServidor($id)
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

    public function actionViewServidor($id)
    {
        return $this->render('servidor/view', [
            'model' => $this->findModel($id),
        ]);
    }

    # ------------------------------------------------------ #

    /**
     * Displays a single Pessoa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
