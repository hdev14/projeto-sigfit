<?php

namespace app\controllers;

use app\models\Equipamento;
use Yii;
use app\models\Exercicio;
use app\models\ExercicioSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExercicioController implements the CRUD actions for Exercicio model.
 */
class ExercicioController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new ExercicioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExercicios()
    {
        $query = Exercicio::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 12,
        ]);

        $exercicios = $query->orderBy('nome')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('exercicios', [
            'exercicios' => $exercicios,
            'pagination' => $pagination
        ]);
    }

    public function actionAerobicos()
    {
        $query = Exercicio::find()->where(['tipo' => 'aerobico']);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
        ]);

        $exercicios_aerobicos = $query->orderBy('nome')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('exercicios', [
            'exercicios' => $exercicios_aerobicos,
            'pagination' => $pagination
        ]);
    }

    public function actionAnaerobicos()
    {
        $query = Exercicio::find()->where(['tipo' => 'anaerobico']);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
        ]);

        $exercicios_anaerobicos = $query->orderBy('nome')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('exercicios', [
            'exercicios' => $exercicios_anaerobicos,
            'pagination' => $pagination
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'equipamentos' => Equipamento::find()->all(),
        ]);
    }

    public function actionCreate($equipamento_id = null)
    {
        $model = new Exercicio();
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $session->addFlash('success', 'Exercício registrado com sucesso !');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $session->addFlash('error', 'Não foi possível registrar o exercício.');
            }
        }

        $model->equipamento_id = $equipamento_id;

        return $this->render('create', [
            'model' => $model,
            'equipamentos' => Equipamento::find()->all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->save())
                $session->addFlash('success', 'Exercício atualizado com sucesso !');
            else
                $session->addFlash('error', 'Não foi possível editar o exercício.');
        }

        return $this->redirect(['exercicio/view', 'id' => $model->id]);
    }

    public function actionDelete($id)
    {
        $exercicio = $this->findModel($id);
        $session = Yii::$app->session;

        foreach ($exercicio->treinoExercicios as $treinoExercicio)
            $treinoExercicio->delete();

        if ($exercicio->delete())
            $session->addFlash('success', 'Exercício excluído com sucesso !');
        else
            $session->addFlash('error', "Não foi possível excluir o exercício.");

        return $this->redirect(['exercicios']);
    }

    protected function findModel($id)
    {
        if (($model = Exercicio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
