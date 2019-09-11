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
        $avaliacao_model = $this->findModelAvaliacao($id);
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
        $usuario = Pessoa::findOne($usuario_id);

        $avaliacao_model = new Avaliacao(['scenario' => Avaliacao::SCENARIO_AVALIACAO]);
        $peso_model = new Peso();
        $imc_model = new Imc();
        $pdg_model = new PercentualGordura();

        $post = Yii::$app->request->post();

        Yii::debug($post);

        $avaliacao_model->pessoa_id = $usuario->id;

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
            'sexo' => $usuario->sexo,
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
        $model = $this->findModelAvaliacao($id);

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
        $avaliacao_model = $this->findModelAvaliacao($id);

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
     * @param null $avaliacao_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreatePeso($avaliacao_id = null) {

        if ($avaliacao_id === null)
            throw new NotFoundHttpException("Página não encontrada.");

        $peso = new Peso(['scenario' => Peso::SCENARIO_PESO]);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $peso->avaliacao_id = $avaliacao_id;

        if ($peso->load($post)) {

            if ($peso->save()) {
                $session->addFlash('success', 'Peso registrado !');
                return $this->goHome(); // TODO: volta para a página do usuário.
            }
            $session->addFlash('error', 'Não foi possível registra o novo peso.');
        }

        return $this->render('../peso/create', [
            'model' => $peso,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdatePeso($id) {

        $peso = $this->findModelPeso($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($peso->load($post)) {

            if ($peso->save()) {
                $session->addFlash('success', 'Peso editado !');
                return $this->goBack(); // TODO: Implementar o redirecionamento.
            }
            $session->addFlash('error', 'Não foi possível editar o peso.');
        }

        return $this->render('../peso/update', [
            'model' => $peso,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeletePeso($id) {
        $this->findModelPeso($id)->delete();
        return $this->goBack();
    }

    /**
     * @param null $avaliacao_id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreateImc($avaliacao_id = null) {

        if ($avaliacao_id === null)
            throw new NotFoundHttpException('Página não encontrada.');

        $imc = new Imc(['scenario' => Imc::SCENARIO_IMC]);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $imc->avaliacao_id = $avaliacao_id;

        if ($imc->load($post)) {

            if ($imc->save()) {
                $session->addFlash('success', 'IMC registrado !');
                return $this->goBack(); # TODO: Implementar o redirecionamento.
            }
            $session->addFlash('error', 'Não foi possivel criar o novo IMC.');
        }

        return $this->render('../imc/create', [
            'model' => $imc,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdateImc($id) {

        $imc = $this->findModelImc($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($imc->load($post)) {

            if ($imc->save()) {
                $session->addFlash('success', 'IMC editado !');
                return $this->goBack(); # TODO: Implementar o redirecionamento.
            }
            $session->addFlash('error', 'Não foi possível editar o IMC');
        }

        return $this->render('../imc/update', [
            'model' => $imc
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImc($id) {
        $this->findModelImc($id)->delete();
        return $this->goBack(); # TODO: Implementar o redirecionamento.
    }

    /**
     * @param null $avaliacao_id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreatePg($avaliacao_id = null) {
        if ($avaliacao_id === null)
            throw new NotFoundHttpException('Página não encontrada.');

        $pg = new PercentualGordura([
            'scenario' => PercentualGordura::SCENARIO_PG
        ]);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $pg->avaliacao_id = $avaliacao_id;

        if ($pg->load($post)) {

            if ($pg->save()) {
                $session->addFlash('success', 'Percentual de Gordura registrado !');
                return $this->goBack(); # TODO: Implementar o redirecionamento.
            }
            $session->addFlash('error', 'Não foi possível registrar o percentual de gordura.');
        }

        return $this->render('../percentual-gordura/create', [
            'model' => $pg,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdatePg($id) {
        $pg = $this->findModelPg($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($pg->load($post)) {

            if ($pg->save()) {
                $session->addFlash('success', 'Percentual de Gordura editado !');
                return $this->goBack(); # TODO: Implementar o redirecionamento.
            }
            $session->addFlash('error', 'Não foi possível editar o percentual de gordura.');
        }

        return $this->render('../percentual-gordura/update', [
            'model' => $pg,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeletePg($id) {
        $this->findModelPg($id)->delete();
        return $this->goBack();
    }

    /**
     * Finds the Avaliacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avaliacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelAvaliacao($id)
    {
        if (($model = Avaliacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return Peso|null
     * @throws NotFoundHttpException
     */
    protected function findModelPeso($id)
    {
        if (($model = Peso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return Imc|null
     * @throws NotFoundHttpException
     */
    protected function findModelImc($id)
    {
        if (($model = Imc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return PercentualGordura|null
     * @throws NotFoundHttpException
     */
    protected function findModelPg($id)
    {
        if (($model = PercentualGordura::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
