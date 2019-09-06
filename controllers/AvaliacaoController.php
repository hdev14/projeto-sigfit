<?php

namespace app\controllers;

use app\models\Imc;
use app\models\PercentualGordura;
use app\models\Peso;
use Yii;
use app\models\Avaliacao;
use app\models\AvaliacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliacaoController implements the CRUD actions for Avaliacao model.
 */
class AvaliacaoController extends Controller
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
     * Lists all Avaliacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AvaliacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avaliacao model.
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
     * @param null $usuario_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate($usuario_id = null)
    {
        if (is_null($usuario_id))
            throw new NotFoundHttpException('Sinto muito, página não encontrada.');

        $avaliacao_model = new Avaliacao();
        $peso_model = new Peso();
        $imc_model = new Imc();
        $pdg_model = new PercentualGordura();

        $post = Yii::$app->request->post();

        Yii::debug($usuario_id, "USUARIO_ID");
        $avaliacao_model->pessoa_id = $usuario_id;

        if (($avaliacao_model->load($post) && $avaliacao_model->validate())
            && ($peso_model->load($post) && $peso_model->validate())
            && ($imc_model->load($post) && $imc_model->validate())
            && ($pdg_model->load($post) && $pdg_model->validate())) {

            Yii::debug("V A L I D A T E");

            $avaliacao_model->data = date('Y-m-d');

            if ($avaliacao_model->save()) {

                $peso_model->avaliacao_id = $avaliacao_model->id;
                $imc_model->avaliacao_id = $avaliacao_model->id;
                $pdg_model->avaliacao_id = $avaliacao_model->id;

                if ($peso_model->save()
                    && $imc_model->save()
                    && $pdg_model->save()) {
                    return $this->redirect([
                        'view',
                        'id' => $avaliacao_model->id
                    ]);
                }
            }
        }

        return $this->render('create', [
            'avaliacao_model' => $avaliacao_model,
            'peso_model' => $peso_model,
            'imc_model' => $imc_model,
            'pdg_model' => $pdg_model,
        ]);
    }

    /**
     * Updates an existing Avaliacao model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Avaliacao model.
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
     * Finds the Avaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avaliacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
