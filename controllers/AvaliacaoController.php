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

        $avaliacao_model->pessoa_id = $usuario->id;

        if (( $avaliacao_model->load($post) && $avaliacao_model->validate() )
            && ( $peso_model->load($post) && $peso_model->validate() )
            && ( $imc_model->load($post) && $imc_model->validate() )
            && ( $pdg_model->load($post) && $pdg_model->validate() )
            && $avaliacao_model->save()) {

            $peso_model->link('avaliacao', $avaliacao_model);
            $imc_model->link('avaliacao', $avaliacao_model);
            $pdg_model->link('avaliacao', $avaliacao_model);

            return $this->redirect([
                'pessoa/view',
                'id' => $usuario->id,
            ]);
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
        $session = Yii::$app->session;
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save())
                $session->addFlash('success', 'Avaliação atualizada !');
            else
                $session->addFlash('error', 'Não possível edita a avaliação.');

            return $this->redirect(['pessoa/view', 'id' => $model->pessoa_id]);
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
        $usuario_id = $avaliacao_model->pessoa_id;
        $session = Yii::$app->session;
        $resultado = false;

        $pesos = $avaliacao_model->getPesos()->all();
        foreach ($pesos as $peso) {
            $resultado = $peso->delete();
        }

        $imcs = $avaliacao_model->getImcs()->all();
        foreach ($imcs as $imc) {
            $resultado = $imc->delete();
        }

        $pdgs = $avaliacao_model->getPercentualGorduras()->all();
        foreach ($pdgs as $pdg) {
            $resultado = $pdg->delete();
        }

        $resultado = $avaliacao_model->delete();

        if ($resultado !== false)
            $session->addFlash('success', 'Avaliação excluída !');
        else
            $session->addFlash('error', 'Não foi possível excluir a avaliação.');

        return $this->redirect(['pessoa/view', 'id' => $usuario_id]);
    }

    /**
     * @param null $avaliacao_id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreatePeso($avaliacao_id = null)
    {
        $avaliacao = $this->findModelAvaliacao($avaliacao_id);

        $peso = new Peso(['scenario' => Peso::SCENARIO_PESO]);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $peso->avaliacao_id = $avaliacao->id;

        if ($peso->load($post)) {
            if ($peso->save()) {
                $avaliacao->save(false);
                $session->addFlash('success', 'Peso registrado com sucesso !');
            } else {
                $session->addFlash('error', 'Não foi possível registra o novo peso.');
            }
        }

        return $this->redirect([
            'pessoa/view', 'id' => $avaliacao->pessoa_id
        ]);
    }

    public function actionUpdatePeso($id)
    {

        $peso = $this->findModelPeso($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($peso->load($post)) {
            $peso->data = date('Y-m-d');
            if ($peso->save()) {
                $session->addFlash('success', 'Peso editado !');
                return $this->goBack(); // TODO: Implementar o redirecionamento.
            } else {
                $session->addFlash('error', 'Não foi possível editar o peso.');
            }
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
    public function actionDeletePeso($id)
    {
        $this->findModelPeso($id)->delete();
        return $this->goBack();
    }

    public function actionCreateImc($avaliacao_id = null)
    {
        $avaliacao = $this->findModelAvaliacao($avaliacao_id);

        $imc = new Imc(['scenario' => Imc::SCENARIO_IMC]);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $imc->avaliacao_id = $avaliacao->id;

        if ($imc->load($post)) {
            if ($imc->save()) {
                $avaliacao->save(false);
                $session->addFlash('success', 'IMC registrado com sucesso!');
            } else {
                $session->addFlash('error', 'Não foi possível registra o novo IMC.');
            }
        }

        return $this->redirect([
            'pessoa/view',
            'id' => $avaliacao->pessoa_id,
        ]);
    }

    public function actionUpdateImc($id, $usuario_id = null)
    {

        $imc = $this->findModelImc($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($imc->load($post)) {
            $imc->data = date('Y-m-d');
            if ($imc->save())
                $session->addFlash('success', 'IMC editado !');
            else
                $session->addFlash('error', 'Não foi possível editar o IMC');
        }

        if (!is_null($usuario_id)) {
            return $this->redirect(['pessoa/view', 'id' => $usuario_id]);
        }

        return $this->goBack();
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImc($id, $usuario_id = null)
    {
        $session = Yii::$app->session;

        if ($this->findModelImc($id)->delete()) {
            $session->addFlash('success', 'IMC excluído com sucesso !');
        } else {
            $session->addFlash('error', 'Não foi possível excluir o IMC');
        }

        if (!is_null($usuario_id)) {
            return $this->redirect(['pessoa/view', 'id' => $usuario_id]);
        }

        return $this->goBack();
    }

    public function actionCreatePg($avaliacao_id = null)
    {
        $avaliacao = $this->findModelAvaliacao($avaliacao_id);

        $pg = new PercentualGordura([
            'scenario' => PercentualGordura::SCENARIO_PG
        ]);

        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $pg->avaliacao_id = $avaliacao->id;

        if ($pg->load($post)) {
            if ($pg->save()) {
                $avaliacao->save(false);
                $session->addFlash('success', 'Percentual de Gordura registrado !');
            } else {
                $session->addFlash('error', 'Não foi possível registrar o percentual de gordura.');
            }
        }

        return $this->redirect([
            'pessoa/view',
            'id' => $avaliacao->pessoa_id,
        ]);
    }

    public function actionUpdatePg($id)
    {
        $pg = $this->findModelPg($id);
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($pg->load($post)) {
            $pg->data = date('Y-m-d');
            if($pg->save()) {
                $session->addFlash('success', 'Percentual de Gordura editado !');
                return $this->goBack(); # TODO: Implementar o redirecionamento.
            } else {
                $session->addFlash('error', 'Não foi possível editar o percentual de gordura.');
            }
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
    public function actionDeletePg($id)
    {
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
