<?php

namespace app\controllers;

use app\models\Imc;
use app\models\PercentualGordura;
use app\models\Peso;
use app\models\Pessoa;
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
        $avaliacao_model = $this->findModel($id);
        $pesos = $avaliacao_model->getPesos()->all();
        $imcs = $avaliacao_model->getImcs()->all();
        $pdgs = $avaliacao_model->getPercentualGorduras()->all();

        return $this->render('view', [
            'model' => $avaliacao_model,
            'pesos' => $pesos,
            'imcs' => $imcs,
            'pdgs' => $pdgs,
        ]);
    }

    /**
     * @param null $usuario_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate($usuario_id = null)
    {
        if ($usuario_id === null)
            throw new NotFoundHttpException("Página não encontrada.");

        $avaliacao_model = new Avaliacao(['scenario' => Avaliacao::SCENARIO_AVALIACAO]);
        $peso_model = new Peso();
        $imc_model = new Imc();
        $pdg_model = new PercentualGordura();

        $post = Yii::$app->request->post();

        $avaliacao_model->pessoa_id = $usuario_id;

        if (($avaliacao_model->load($post) && $avaliacao_model->validate())
            && ($peso_model->load($post) && $peso_model->validate())
            && ($imc_model->load($post) && $imc_model->validate())
            && ($pdg_model->load($post) && $pdg_model->validate())) {

            $avaliacao_model->data = date('Y-m-d');

            if ($avaliacao_model->save()) {

                $peso_model->link('avaliacao', $avaliacao_model);
                $imc_model->link('avaliacao', $avaliacao_model);
                $pdg_model->link('avaliacao', $avaliacao_model);

                return $this->redirect([
                    'view',
                    'id' => $avaliacao_model->id
                ]);

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
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $avaliacao_model = $this->findModel($id);

        $pesos = $avaliacao_model->getPesos()->all();
        foreach ($pesos as $peso) {
            $peso->delete();
        }

        $imcs = $avaliacao_model->getImcs()->all();
        foreach ($imcs as $imc) {
            $imc->delete();
        }

        $pdgs = $avaliacao_model->getPercentualGorduras()->all();
        foreach ($pdgs as $pdg) {
            $pdg->delete();
        }

        $avaliacao_model->delete();

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
